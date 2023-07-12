<?php

namespace App\Services\TradeSafe;

use Illuminate\Support\Facades\Http;
use JetBrains\PhpStorm\NoReturn;

class Service
{
    /**
     * @var string The client ID for the TradeSafe API.
     */
    protected string $client_id;
    protected function getClientId(): string { return $this->client_id; }
    protected function setClientId(string $client_id): void { $this->client_id = $client_id; }

    /**
     * @var string The client secret for the TradeSafe API.
     */
    protected string $client_secret;
    public function getClientSecret(): string { return $this->client_secret; }
    public function setClientSecret(string $client_secret): void { $this->client_secret = $client_secret;}

    /**
     * @var string The base URL for the TradeSafe API.
     */
    protected string $base_url;
    public function getBaseUrl(): string { return $this->base_url; }
    public function setBaseUrl(string $base_url): void { $this->base_url = $base_url; }

    /**
     * @var AccessToken The access token for the TradeSafe API.
     */
    protected AccessToken $access_token;
    protected function setAccessToken(AccessToken $access_token): void { $this->access_token = $access_token; }

    #[NoReturn] public function __construct()
    {
        $this->setClientId(config('tradesafe.authentication.client_id'));
        $this->setClientSecret(config('tradesafe.authentication.client_secret'));
        $this->setBaseUrl(config('tradesafe.base_url', 'https://auth.tradesafe.co.za'));

        $this->authenticate();
    }

    protected function authenticate(): void
    {
        /*
         * This is where we will authenticate with the TradeSafe API.
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
            url: $this->base_url . '/oauth/token',
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
}
