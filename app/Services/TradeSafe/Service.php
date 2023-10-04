<?php

namespace App\Services\TradeSafe;

use App\Enums\PARTY_ROLES;
use App\Models\Buyer;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use App\Services\TradeSafe\GraphQL\Mutations\Deposits;
use App\Types\Allocation;
use App\Types\BankAccount;
use App\Types\Organisation;
use App\Types\Party;
use App\Types\SellerToken;
use App\Types\UserToken;
use Illuminate\Support\Facades\Http;
use JetBrains\PhpStorm\NoReturn;
use BendeckDavid\GraphqlClient\Facades\GraphQL;

use App\Services\TradeSafe\GraphQL\Queries\Tokens as TokenQueries;
use App\Services\TradeSafe\GraphQL\Mutations\Tokens as TokenMutations;
use App\Services\TradeSafe\GraphQL\Queries\Transactions as TransactionQueries;
use App\Services\TradeSafe\GraphQL\Mutations\Transactions as TransactionMutations;
use App\Services\TradeSafe\Types\AccessToken;

class Service
{
    /**
     * @var string The client ID for the TradeSafe API.
     */
    private string $client_id;
    public function getClientId(): string { return $this->client_id; }
    protected function setClientId(string $client_id): void { $this->client_id = $client_id; }

    /**
     * @var string The client secret for the TradeSafe API.
     */
    private string $client_secret;
    public function getClientSecret(): string { return $this->client_secret; }
    protected function setClientSecret(string $client_secret): void { $this->client_secret = $client_secret;}

    /**
     * @var string The base URL for the TradeSafe API.
     */
    private string $auth_endpoint;
    public function getAuthEndpoint(): string { return $this->auth_endpoint; }
    protected function setAuthEndpoint(string $auth_endpoint): void { $this->auth_endpoint = $auth_endpoint; }

    /**
     * @var AccessToken The access token for the TradeSafe API.
     */
    protected AccessToken $access_token;
    protected function setAccessToken(AccessToken $access_token): void { $this->access_token = $access_token; }

    #[NoReturn] public function __construct()
    {
        $this->setClientId(config('tradesafe.authentication.client_id'));
        $this->setClientSecret(config('tradesafe.authentication.client_secret'));
        $this->setAuthEndpoint(config('tradesafe.authentication.auth_endpoint'));

        $this->authenticate();
    }

    protected function authenticate(): void
    {
        /*
         * This is where we will authenticate with the TradeSafe API.
         *
         * curl --request POST \
         * --url 'https://auth.tradesafe.co.za/oauth/token' \
         * --header 'content-type: application/x-www-form-urlencoded' \
         * --data grant_type=client_credentials \
         * --data client_id=YOUR_CLIENT_ID \
         * --data client_secret=YOUR_CLIENT_SECRET
         *
         * https://developer.tradesafe.co.za/docs/1.3/api/authentication
         */

        $response = Http::post(
            url: $this->auth_endpoint,
            data: [
                'grant_type' => 'client_credentials',
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
            ]);

        $this->setAccessToken(new AccessToken($response->json()));
    }

    /**
     * Returns the access token for the TradeSafe API.
     * @return AccessToken
     */
    public function getAccessToken(): AccessToken
    {
        return $this->access_token;
    }

    /**
     * Returns the list of tokens for the TradeSafe API.
     * @return mixed
     */
    public function listTokens(): mixed
    {
        return GraphQL::query(TokenQueries::$listTokens)
            ->withToken($this->access_token->getAccessToken())
            ->get();
    }

    /**
     * Returns the list of transactions that can be used to generate the checkout tokens.
     * @return mixed
     */
    public function listTransactions(): mixed
    {
        return GraphQL::query(TransactionQueries::$listTransactions)
            ->withToken($this->access_token->getAccessToken())
            ->get();
    }

    /**
     * Create a token that will be used to represent a buyer in transactions.
     * @param Buyer $buyer
     * @return mixed
     */
    public function createBuyerToken(Buyer $buyer): mixed
    {
        $user = $buyer->user;
        return GraphQL::mutation(TokenMutations::createBuyerToken(
            token_user: new UserToken(
                givenName: $user->given_name,
                familyName: $user->family_name,
                email: $user->email,
                mobile: $user->mobile,
            ),
        ))
            ->withToken($this->access_token->getAccessToken())
            ->get();
    }

    /**
     * Create a token that will be used to represent a seller in transactions.
     * @param Seller $seller
     * @return mixed
     */
    public function createSellerToken(Seller $seller): mixed
    {
        $user = $seller->user;
        return GraphQL::mutation(TokenMutations::createSellerToken(
            seller: new SellerToken(
                user: new UserToken(
                    givenName: $user->given_name,
                    familyName: $user->family_name,
                    email: $user->email,
                    mobile: $user->mobile,
                ),
                bank_account: new BankAccount(
                    accountNumber: '123456789',
                    accountType: 'SAVINGS',
                    bankName: 'SBSA',
                ),
                organisation: new Organisation(
                    organisationName: 'Test Organisation',
                    tradeName: 'Test Organisation',
                    type: 'PRIVATE',
                    registrationNumber: '123456789',
                    taxNumber: '123456789',
                ),
            ),
        ))
            ->withToken($this->access_token->getAccessToken())
            ->get();
    }

    /**
     * Create a transaction between a seller and a single buyer.
     * @return mixed
     */
    public function createTransaction(
        Product $product,
        Buyer $buyer,
        Seller $seller,
    ): mixed
    {
        /*
         * TODO Jaak 2023-07-30:
         * We will have to keep track of the values going out and the sum of the transaction
         * totals
         */
        return GraphQL::mutation(TransactionMutations::createTransaction(
            title: 'Test Transaction',
            description: 'Test Transaction Description',
            allocation: new Allocation(
                title: $product->title,
                description: $product->description,
                value: $product->price,
                daysToDeliver: 1,
                daysToInspect: 1,
            ),
            buyer: new Party(
                token: '2n22PCWS37rtiGZNSfDyvy',
                role: PARTY_ROLES::BUYER,
            ),
            seller: new Party(
                token: '1vyziRQz8hOwaPDnfmTufX',
                role: PARTY_ROLES::SELLER,
            )
        ))
            ->withToken($this->access_token->getAccessToken())
            ->get();
    }

    /**
     * Create a checkout link that can be attached to the checkout button. This defaults to a link to embed, but can
     * also be used to redirect the user to the TradeSafe hosted checkout page.
     * @param string $transactionId
     * @param array $paymentMethods
     * @param bool $embed
     * @return mixed
     */
    public function createCheckoutLink(
        string $transactionId = '5gpFrguZdibQoSTk2rfzjC',
        array $paymentMethods = ['EFT', 'INSTANT_EFT', 'CARD'],
        bool $embed = false,
    ): mixed
    {
        $mutation = Deposits::createCheckoutLink(
            transactionId: $transactionId,
            paymentMethods: $paymentMethods,
            embed: $embed
        );

        return GraphQL::mutation($mutation)
            ->withToken($this->access_token->getAccessToken())
            ->get();
    }
}
