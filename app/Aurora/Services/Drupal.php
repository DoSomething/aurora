<?php namespace Aurora\Services\Drupal;

class DrupalAPI {

  protected $client;

  public function __construct()
  {
    $base_url = \Config::get('services.drupal.url');

    $client = new \GuzzleHttp\Client(['base_url' => $base_url]);

    $this->client = $client;
  }


  public function getCampaign($id)
  {

    $response = $this->client->get('campaigns/' . $id);

    return $response->json()['data'];
  }

}