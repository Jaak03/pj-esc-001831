<?php

namespace App\Traits;

use App\Facades\TradeSafe;
use App\Models\Buyer;
use App\Models\Seller;
use App\Models\User;
use Arr;
use Exception;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UsesTradeSafe
{
    /**
     * Returns the user relationship that this entity belongs too.
     * @return mixed
     */
    public function hasToken(): bool
    {
        return (bool)$this?->token;
    }

    /**
     * Returns the token that is registered for the user, if none exists yet then one is created on the platform.
     * @return string
     */
    public function getToken(): string
    {
        $token = $this?->token;

        if ($token) return $token;

        return $this->createToken();
    }

    /**
     * @throws Exception
     */
    public function addTradeSafeToken(): self
    {
        if ($this->hasToken()) return $this;

        $token = match (get_class($this)) {
            Buyer::class => TradeSafe::createBuyerToken($this),
            Seller::class => TradeSafe::createSellerToken($this),
            default => throw new Exception('Invalid class type.'),
        };

        if (!Arr::has($token, 'tokenCreate.id')) {
            throw new Exception('Invalid token response.');
        }

        $this->token = Arr::get($token, 'tokenCreate.id');
        $this->save();

        return $this;
    }
}
