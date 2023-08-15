<?php

namespace App\Types;

class UserToken
{
    public function __construct(
        private string $givenName,
        private string $familyName,
        private string $email,
        private string $mobile
    )
    {}

    /**
     * @return string
     */
    public function getFamilyName(): string
    {
        return $this->familyName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getMobile(): string
    {
        return $this->mobile;
    }

    /**
     * @return string
     */
    public function getGivenName(): string
    {
        return $this->givenName;
    }
}
