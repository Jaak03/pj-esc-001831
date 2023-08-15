<?php

return [

    /*
     * The API secrets to be used when making requests to TradeSafe.
     */
    'authentication' => [
        'client_id' => env('TRADESAFE_CLIENT_ID', null),
        'client_secret' => env('TRADESAFE_CLIENT_SECRET', null),
        'auth_endpoint' => env('TRADESAFE_AUTH_ENDPOINT', null),
    ],

    /*
     * The API base URL to be used when making requests to TradeSafe.
     *
     * P.S. I am not sure about this API URL.
     */
    'graphql_endpoint' => env('TRADESAFE_BASE_URL', 'https://api-developer.tradesafe.dev/graphql'),
];
