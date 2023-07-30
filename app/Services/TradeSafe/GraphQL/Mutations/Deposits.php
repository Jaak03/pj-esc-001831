<?php

namespace App\Services\TradeSafe\GraphQL\Mutations;

class Deposits
{
    private static string $create_hosted_checkout_link = <<<MUTATION
checkoutLink(
    transactionId: "%s"
    paymentMethods: [EFT, INSTANT_EFT, CARD]
)
MUTATION;

    /**
     * Link that takes the buyer through the payment portals to deposit funds into the transaction.
     * @param string $transaction_id
     * @return string
     */
    public static function createHostedCheckoutLink(string $transaction_id): string
    {
        return sprintf(self::$create_hosted_checkout_link, $transaction_id);
    }
}
