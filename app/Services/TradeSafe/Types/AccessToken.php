<?php

namespace App\Services\TradeSafe\Types;

use Illuminate\Support\Carbon;
use JetBrains\PhpStorm\NoReturn;

class AccessToken
{
    /**
     * @var string The access token returned from the TradeSafe API.
     */
    private string $access_token;
    private function setAccessToken(string $access_token): void { $this->access_token = $access_token; }
    public function getAccessToken(): string { return $this->access_token; }

    /**
     * @var string The type of the token returned from the TradeSafe API.
     */
    private string $token_type;
    private function setTokenType(string $token_type): void { $this->token_type = $token_type; }
    public function getTokenType(): string { return $this->token_type; }

    /**
     * @var int The number of seconds the token is valid for.
     */
    private int $expires_in;
    private function setExpiresIn(int $expires_in): void { $this->expires_in = $expires_in; }
    public function getExpiresIn(): int { return $this->expires_in; }

    /**
     * @var string The refresh token returned from the TradeSafe API.
     */
    private string $refresh_token;
    private function setRefreshToken(string $refresh_token): void { $this->refresh_token = $refresh_token; }
    public function getRefreshToken(): string { return $this->refresh_token; }

    /**
     * @var Carbon The date and time the token was created.
     */
    private Carbon $created_at;
    private function setCreatedAt(Carbon $created_at): void { $this->created_at = $created_at; }
    public function getCreatedAt(): Carbon { return $this->created_at; }

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
            'token_type' => $this->getTokenType(),
            'expires_in' => $this->getExpiresIn(),
            'created_at' => $this->getCreatedAt(),
        ];
    }
}
