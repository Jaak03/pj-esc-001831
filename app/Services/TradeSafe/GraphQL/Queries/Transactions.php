<?php

namespace App\Services\TradeSafe\GraphQL\Queries;

class Transactions
{
    /**
     * https://developer.tradesafe.co.za/docs/1.3/api/tokens#list
     *
     * The token query is used to get a list of tokens that you have created. By default, your organization already has
     * a token generated as part of the signup process.
     *
     * @var string
     */
    public static string $listTransactions = <<<MUTATION
transactions {
    data {
        title
        description
        industry
        state
        createdAt
    }
}
MUTATION;
}
