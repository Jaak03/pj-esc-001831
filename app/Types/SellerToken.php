<?php

namespace App\Types;

class SellerToken
{
    public function __construct(
        private UserToken $user,
        private BankAccount $bank_account,
        private Organisation $organisation
    )
    {}

    /**
     * @return BankAccount
     */
    public function getBankAccount(): BankAccount
    {
        return $this->bank_account;
    }

    /**
     * @return Organisation
     */
    public function getOrganisation(): Organisation
    {
        return $this->organisation;
    }

    /**
     * @return UserToken
     */
    public function getUser(): UserToken
    {
        return $this->user;
    }

}
