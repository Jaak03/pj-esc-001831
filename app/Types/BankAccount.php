<?php

namespace App\Types;

class BankAccount
{
    public function __construct(
        private string $account_number,
        private string $account_type,
        private string $bank
    )
    {}

    /**
     * @return string
     */
    public function getAccountNumber(): string
    {
        return $this->account_number;
    }

    /**
     * @return string
     */
    public function getAccountType(): string
    {
        return $this->account_type;
    }

    /**
     * @return string
     */
    public function getBank(): string
    {
        return $this->bank;
    }
}
