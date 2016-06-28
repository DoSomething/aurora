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
        'url'     => env('NORTHSTAR_URL'),
        'client_id' => env('NORTHSTAR_CLIENT_ID'),
        'client_secret' => env('NORTHSTAR_CLIENT_SECRET'),
        'authorization_server_url' => env('NORTHSTAR_URL'),
        'repository' => \Aurora\Auth\OAuthRepository::class,
        'scope' => ['admin', 'user'],
    ],

    'drupal' => [
        'url' => env('DRUPAL_URL'),
    ],

    'mobile_commons' => [
        'username' => env('MOBILE_COMMONS_USERNAME'),
        'password' => env('MOBILE_COMMONS_PASSWORD'),
    ],

];
