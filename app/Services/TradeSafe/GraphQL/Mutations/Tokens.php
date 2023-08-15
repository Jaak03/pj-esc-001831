<?php

namespace App\Services\TradeSafe\GraphQL\Mutations;

use App\Types\SellerToken;
use App\Types\UserToken;
use App\Traits\ReturnsStrings;

class Tokens
{
    use ReturnsStrings;

    private static string $create_buyer_token_mutation = <<<MUTATION
tokenCreate(input: {
    user: {
        givenName: "%s",
        familyName: "%s",
        email: "%s",
        mobile: "%s",
    }
}) {
    id
}
MUTATION;
    private static string $create_seller_token_mutation = <<<MUTATION
tokenCreate(input: {
    user: {
        givenName: "%s",
        familyName: "%s",
        email: "%s",
        mobile: "%s",
    }
    organization: {
        name: "%s"
        tradeName: "%s"
        type: %s
        registrationNumber: "%s"
        taxNumber: "%s"
    }
    bankAccount: {
        accountNumber: "%s",
        accountType: %s,
        bank: %s
    }
    settings: {
        payout: {
            interval: ACCOUNT,
            refund: IMMEDIATE,
        }
    }
}) {
    id
}
MUTATION;

    /**
     *
     * @param UserToken $token_user
     * @return string
     */
    public static function createBuyerToken(UserToken $token_user): string
    {
        $response = sprintf(self::$create_buyer_token_mutation,
            $token_user->getGivenName(),
            $token_user->getFamilyName(),
            $token_user->getEmail(),
            $token_user->getMobile(),
        );

        return self::strip($response);
    }

    public static function createSellerToken(SellerToken $seller): string
    {
        $response = sprintf(self::$create_seller_token_mutation,
            $seller->getUser()->getGivenName(),
            $seller->getUser()->getFamilyName(),
            $seller->getUser()->getEmail(),
            $seller->getUser()->getMobile(),
            $seller->getOrganisation()->getName(),
            $seller->getOrganisation()->getTradeName(),
            $seller->getOrganisation()->getType(),
            $seller->getOrganisation()->getRegistrationNumber(),
            $seller->getOrganisation()->getTaxNumber(),
            $seller->getBankAccount()->getAccountNumber(),
            $seller->getBankAccount()->getAccountType(),
            $seller->getBankAccount()->getBank(),
        );

        return self::strip($response);
    }
}
