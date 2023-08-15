<?php

namespace App\Services\TradeSafe\GraphQL\Mutations;

class Deposits
{
    private static string $create_checkout_link = <<<MUTATION
checkoutLink(
    transactionId: "%s",
    paymentMethods: %s,
    embed: %s
)
MUTATION;

    /**
     * Link that takes the buyer through the payment portals to deposit funds into the transaction.
     * @param string $transactionId
     * @param array $paymentMethods
     * @param bool $embed
     * @return string
     */
    public static function createCheckoutLink(
        string $transactionId,
        array $paymentMethods,
        bool $embed,
    ): string
    {
        return sprintf(
            self::$create_checkout_link,
            $transactionId,
            '[' . implode(', ', $paymentMethods) . ']',
            $embed ? 'true' : 'false'
        );
    }
}
