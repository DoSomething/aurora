<?php

namespace Aurora\Services;

use GuzzleHttp\Client;

class Drupal
{
    protected $client;

    public function __construct()
    {
        $base_url = \Config::get('services.drupal.url');

        $client = new Client(['base_url' => $base_url]);

        $this->client = $client;
    }

  /**
   * Send a GET request to return campaign information
   *
   * @param string campaign ID
   * @return JSON file
   */
  public function getCampaignFromDrupal($id)
  {
      $response = $this->client->get('campaigns/'.$id);
      if (isset($response->json()['data'])) {
          return $response->json()['data'];
      }
  }

  /**
   * Send a GET request to return a user reportbacks information
   *
   * @param string reportback ID
   * @return JSON file
   */
  public function getReportbacksFromDrupal($id)
  {
      $response = $this->client->get('reportbacks/'.$id.'.json');
      if (isset($response->json()['data'])) {
          return $response->json()['data'];
      }
  }
}
