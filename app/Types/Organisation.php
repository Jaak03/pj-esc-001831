<?php

namespace App\Types;

class Organisation
{
    public function __construct(
        private string $name,
        private string $tradeName,
        private string $type,
        private string $registration_number,
        private string $tax_number
    )
    {}

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getTradeName(): string
    {
        return $this->tradeName;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getRegistrationNumber(): string
    {
        return $this->registration_number;
    }

    /**
     * @return string
     */
    public function getTaxNumber(): string
    {
        return $this->tax_number;
    }
}
