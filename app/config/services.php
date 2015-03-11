<?php

return array(

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

  'mailgun' => array(
    'domain' => '',
    'secret' => '',
  ),

  'mandrill' => array(
    'secret' => '',
  ),

  'stripe' => array(
    'model'  => 'User',
    'secret' => '',
  ),
 'northstar' => array(
      'url'     => getenv('NORTHSTAR_URL'),
      'version' => '1',
      'app_id'  => getenv('NORTHSTAR_APP_ID'),
      'api_key' => getenv('NORTHSTAR_API_KEY')
  ),

);
