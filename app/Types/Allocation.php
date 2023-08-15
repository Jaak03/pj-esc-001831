<?php

namespace App\Types;

class Allocation
{
    /**
     * @param string $title
     * @param string $description
     * @param int $value In cents.
     * @param int $daysToDeliver
     * @param int $daysToInspect
     */
    public function __construct(
        private string $title,
        private string $description,
        private int $value,
        private int $daysToDeliver,
        private int $daysToInspect
    )
    {}

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value / 100;
    }

    /**
     * @return int
     */
    public function getDaysToDeliver(): int
    {
        return $this->daysToDeliver;
    }

    /**
     * @return int
     */
    public function getDaysToInspect(): int
    {
        return $this->daysToInspect;
    }
}
