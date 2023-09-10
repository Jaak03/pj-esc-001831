<?php

namespace App\Traits;

use App\Facades\TradeSafe;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UsesTradeSafe
{
    /**
     * Returns the user relationship that this entity belongs too.
     * @return mixed
     */
    public function hasToken(): bool
    {
        return (bool)$this?->user?->token;
    }

    /**
     * Returns the token that is registered for the user, if none exists yet then one is created on the platform.
     * @return string
     */
    public function getToken(): string
    {
        $token = $this?->user?->token;

        if ($token) return $token;

        return $this->createToken();
    }

    public function createToken(): string
    {
        dd(self::class);
        $token = $this->user->createToken('TradeSafe')->plainTextToken;
        $this->user->token = $token;
        $this->user->save();
        return $token;
    }
}
