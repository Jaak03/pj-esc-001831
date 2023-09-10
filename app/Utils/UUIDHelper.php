<?php

namespace App\Utils;

use Str;

class UUIDHelper
{
    /**
     * Generate a UUID.
     *
     * @return string
     */
    public static function generate(): string
    {
        return (string) Str::uuid();
    }
}
