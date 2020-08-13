<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'northstar' => [
        'grant' => 'authorization_code',
        'url' => env('NORTHSTAR_URL'),
        'authorization_code' => [
            'client_id' => env('NORTHSTAR_CLIENT_ID'),
            'client_secret' => env('NORTHSTAR_CLIENT_SECRET'),
            'scope' => ['role:admin', 'role:staff', 'user', 'openid', 'client', 'write'],
            'redirect_uri' => 'auth/login',
        ],
    ],

    'customerio' => [
        'profile_url' => env('CUSTOMER_IO_PROFILE_URL', 'https://fly.customer.io/env/63704/people'),
    ],

    'gambit' => [
        'profile_url' => env('GAMBIT_PROFILE_URL', 'https://gambit-admin.herokuapp.org/users'),
    ],

    'rogue' => [
        'profile_url' => env('ROGUE_PROFILE_URL', 'https://activity.dosomething.org/users'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'fastly' => [
        'url' => 'https://api.fastly.com',
        'service_id' => env('FASTLY_SERVICE_ID'),
        'service_url' => env('FASTLY_SERVICE_URL'),
        'api_key' => env('FASTLY_API_KEY'),
        'redirects_table' => env('FASTLY_TABLE_REDIRECTS'),
    ],
];
