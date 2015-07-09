<?php namespace Aurora\Services\Drupal;

class DrupalAPI {

  protected $client;

  public function __construct()
  {
    $base_url = "http://staging.beta.dosomething.org/api/v1/";

    $client = new \GuzzleHttp\Client(['base_url' => $base_url]);

    $this->client = $client;
  }


  public function getCampaign()
  {

    $response = $this->client->get('campaigns/362');

    return $response->json()['data'];
  }

}