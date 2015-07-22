<?php namespace Aurora\Services\Drupal;

use GuzzleHttp\Client;

class DrupalAPI {

  protected $client;

  public function __construct()
  {
    $base_url = \Config::get('services.drupal.url');

    $client = new Client(['base_url' => $base_url]);

    $this->client = $client;
  }


  public function getCampaignFromDrupal($id)
  {
    $response = $this->client->get('campaigns/' . $id);
    if(!empty($response->json()['data'])){
      return $response->json()['data'];
    }
  }

  public function getReportbacksFromDrupal($id)
  {
    $response = $this->client->get('reportbacks/' . $id . '.json');

    return $response->json()['data'];
  }

}
