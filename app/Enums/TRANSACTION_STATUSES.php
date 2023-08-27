<?php

namespace App\Enums;

enum TRANSACTION_STATUSES: string
{
    case PENDING = 'pending';
    case PAID = 'paid';
    case CANCELLED = 'cancelled';
    case REFUNDED = 'refunded';
    case COMPLETED = 'completed';

    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
