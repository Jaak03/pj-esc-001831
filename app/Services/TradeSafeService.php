<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TradeSafeService
{
    public function __construct()
    {
        $this->client_id = config('tradesafe.authentication.client_id');
        $this->client_secret = config('tradesafe.authentication.client_secret');
        $this->base_url = config('tradesafe.base_url', 'https://auth.tradesafe.co.za');
    }
}
