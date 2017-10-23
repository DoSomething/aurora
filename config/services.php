<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'northstar' => [
        'grant' => 'authorization_code',
        'url' => env('NORTHSTAR_URL'),
        'key' => storage_path('keys/public.key'),
        'authorization_code' => [
            'client_id' => env('NORTHSTAR_CLIENT_ID'),
            'client_secret' => env('NORTHSTAR_CLIENT_SECRET'),
            'scope' => ['role:admin', 'role:staff', 'user', 'openid'],
            'redirect_uri' => 'auth/login',
        ],
    ],

    'drupal' => [
        'url' => env('DRUPAL_URL'),
    ],

    'gladiator' => [
        'url' => env('GLADIATOR_URL', 'https://gladiator.dosomething.org'),
    ],

];
