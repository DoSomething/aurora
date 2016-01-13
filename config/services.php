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

    'northstar' => array(
        'url'     => env('NORTHSTAR_URL'),
        'version' => 'v1',
        'app_id'  => env('NORTHSTAR_APP_ID'),
        'api_key' => env('NORTHSTAR_API_KEY')
    ),

    'drupal' => [
        'url' => env('DRUPAL_URL')
    ],

    'mobile_commons' => [
        'username' => env('MOBILE_COMMONS_USERNAME'),
        'password' => env('MOBILE_COMMONS_PASSWORD')
    ]

];