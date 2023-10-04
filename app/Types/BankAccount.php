<?php

namespace App\Types;

class BankAccount
{
    public function __construct(
        private readonly string $accountNumber,
        private readonly string $accountType,
        private readonly string $bankName
    )
    {}

    /**
     * @return string
     */
    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }

    /**
     * @return string
     */
    public function getAccountType(): string
    {
        return $this->accountType;
    }

    /**
     * @return string
     */
    public function getBankName(): string
    {
        return $this->bankName;
    }
}
