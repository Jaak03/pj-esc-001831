<?php

return [

    /*
     * The API secrets to be used when making requests to TradeSafe.
     */
    'authentication' => [
        'client_id' => env('TRADESAFE_CLIENT_ID', null),
        'client_secret' => env('TRADESAFE_CLIENT_SECRET', null),
    ],
];
