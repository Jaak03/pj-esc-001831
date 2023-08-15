<?php

namespace App\Types;

use App\Enums\PARTY_ROLES;

class Party
{
    /**
     * @param string $token
     * @param PARTY_ROLES $role
     */
    public function __construct(
        private string $token,
        private PARTY_ROLES $role,
    )
    {}

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role->value;
    }
}
