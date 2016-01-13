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

    'northstar' => array(
      'url'     => 'http://northstar.dev',
      'version' => 'v1',
      'port'    => '8000',
      'app_id'  => '456',
      'api_key' => 'abc4324'
    ),
    'drupal' => array(
      'url' => "http://staging.beta.dosomething.org/api/v1/"
    ),
    'mobile_commons' => array(
      'username' => getenv('MOBILE_COMMONS_USERNAME'),
      'password' => getenv('MOBILE_COMMONS_PASSWORD')
    ),
    'zendesk' => array(
      'url' => 'https://dosomethingorg1.zendesk.com/api/v2/',
      'username' => getenv('ZENDESK_USERNAME'),
      'password' => getenv('ZENDESK_PASSWORD')
    ),
    'mailchimp' => array(
      'apikey' => getenv('MAILCHIMP_API_KEY'),
      'test_id' => getenv('MAILCHIMP_TEST_ID'),
      'international_id' => getenv('MAILCHIMP_INTERNATIONAL_ID'),
      'domestic_id' => getenv('MAILCHIMP_DOMESTIC_ID'),
      'dinosaur_id' => getenv('MAILCHIMP_DINOSAUR_ID')
    ),
  );
