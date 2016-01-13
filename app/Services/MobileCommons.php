<?php

namespace Aurora\Services;

use GuzzleHttp\Client;

class MobileCommons
{
    protected $client;

    public function __construct()
    {
        $base_url = 'https://secure.mcommons.com/api/profile';

        $username = \Config::get('services.mobile_commons.username');

        $password = \Config::get('services.mobile_commons.password');

        $client = new \GuzzleHttp\Client([
      'base_url' => $base_url,
      'defaults' => [
      'auth' => [$username, $password, 'Basic'],
      ],
    ]);

        $this->client = $client;
    }

  /**
   * Send a GET request to return a user profile
   *
   * @param string mobile number
   * @return array user profile
   */
  public function userProfile($mobile)
  {
      $response = $this->client->get('?phone_number='.$mobile.'&include_messages=true');

      $xml = $response->xml();

      $json = json_encode($xml);

      $array = json_decode($json, true);

      if (empty($array['error'])) {
          return array_filter($array['profile']);
      }
  }

  /**
   * Send a GET request to return a user messages
   *
   * @param string mobile number
   * @return array user messages backlog
   */
  public function userMessages($mobile)
  {
      $profile = $this->userProfile($mobile);
      if (! empty($profile)) {
          return array_filter($profile['messages']['message']);
      } else {
          return [];
      }
  }
}
