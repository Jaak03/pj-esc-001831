<?php

namespace App\Traits;

trait HasNameAsOptions
{
    /**
     * Returns the names of an ENUM as an array of options.
     * @return array
     */
    static function getOptions(): array
    {
        return array_column(self::cases(), 'name');
    }
}
