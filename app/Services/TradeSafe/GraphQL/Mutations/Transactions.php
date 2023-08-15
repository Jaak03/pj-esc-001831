<?php

namespace App\Services\TradeSafe\GraphQL\Mutations;

use App\Types\Allocation;
use App\Types\Party;

class Transactions
{
    private static string $create_transaction_mutation = <<<MUTATION
transactionCreate(input: {
    title: "%s",
    description: "%s",
    industry: GENERAL_GOODS_SERVICES,
    currency: ZAR,
    feeAllocation: SELLER,
    allocations: {
      create: [
        {
          title: "%s",
          description: "%s",
          value: %f,
          daysToDeliver: %u,
          daysToInspect: %u
        }
      ]
    },
    parties: {
      create: [
        {
          token: "%s",
          role: %s
        }, {
          token: "%s",
          role: %s
        }
      ]
    }
}) {
    id
    createdAt
}
MUTATION;

    public static function createTransaction(
        string $title,
        string $description,
        Allocation $allocation,
        Party $buyer,
        Party $seller,
    ): string
    {
        return sprintf(self::$create_transaction_mutation,
            $title,
            $description,
            $allocation->getTitle(),
            $allocation->getDescription(),
            $allocation->getValue(),
            $allocation->getDaysToDeliver(),
            $allocation->getDaysToInspect(),
            $buyer->getToken(),
            $buyer->getRole(),
            $seller->getToken(),
            $seller->getRole(),
        );
    }
}
