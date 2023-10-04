<?php

namespace App\Types;

class Organisation
{
    public function __construct(
        private readonly string $organisationName,
        private readonly string $tradeName,
        private readonly string $type,
        private readonly string $registrationNumber,
        private readonly string $taxNumber
    )
    {}

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->organisationName;
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
        return $this->registrationNumber;
    }

    /**
     * @return string
     */
    public function getTaxNumber(): string
    {
        return $this->taxNumber;
    }
}
