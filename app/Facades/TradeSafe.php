<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static createBuyerToken(\App\Models\Buyer $buyer)
 */
class TradeSafe extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'tradesafe';
    }
}
