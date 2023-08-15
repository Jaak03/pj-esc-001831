<?php

namespace App\Traits;

trait ReturnsStrings
{
    /**
     * Removes all the whitespace from the string.
     * @param string $response
     * @return string
     */
    public static function clearWhitespace(string $response): string
    {
        return preg_replace('/\s+/', '', $response);
    }

    /**
     * Strips either end of the string.
     * @param string $response
     * @return string
     */
    public static function strip(string $response): string
    {
        return trim($response);
    }
}
