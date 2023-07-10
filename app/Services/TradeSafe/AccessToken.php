<?php

namespace App\Services\TradeSafe;

use Illuminate\Support\Carbon;
use JetBrains\PhpStorm\NoReturn;

class AccessToken
{
    /**
     * @var string The access token returned from the TradeSafe API.
     */
    protected string $access_token;

    /**
     * @var string The type of the token returned from the TradeSafe API.
     */
    protected string $token_type;

    /**
     * @var int The number of seconds the token is valid for.
     */
    protected int $expires_in;

    /**
     * @var string The refresh token returned from the TradeSafe API.
     */
    protected string $refresh_token;

    /**
     * @var Carbon The date and time the token was created.
     */
    protected Carbon $created_at;

    /**
     * @param array $data
     * @return void
     */
    #[NoReturn] public function __construct(array $data)
    {
        /*
         * Class to store the access token returned from the TradeSafe API.
         *
         *  {
         *      "access_token":"MTQ...jI3",
         *      "token_type":"bearer",
         *      "expires_in":3600,
         *      "refresh_token":""
         *  }
         *
         * https://developer.tradesafe.co.za/docs/1.3/api/authentication
         */

        $this->access_token = $data['access_token'];
        $this->token_type = $data['token_type'];
        $this->expires_in = $data['expires_in'];
        $this->refresh_token = in_array('refresh_token', $data) && $data['refresh_token'];
        $this->created_at = now();
    }

    /**
     * Compares the current date and time to the date and time the token was created to see if the token has expired
     * according to the expiry time returned from the TradeSafe API.
     *
     * @return bool Whether the token has expired.
     */
    public function isExpired(): bool
    {
        return $this->created_at->addSeconds($this->expires_in)->isPast();
    }

    /**
     * Get the access token returned from the TradeSafe API. The response is sanitized to remove any sensitive data,
     * including the access token itself and the refresh token.
     *
     * @return array The sanitized details of the access token.
     */
    public function getTokenDetails(): array
    {
        return [
            'token_type' => $this->token_type,
            'expires_in' => $this->expires_in,
            'created_at' => $this->created_at,
        ];
    }
}
