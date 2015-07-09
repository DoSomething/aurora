<?php namespace Aurora\Services\Drupal;

class DrupalAPI {

  protected $client;

  public function __construct()
  {
    $base_url = "http://staging.beta.dosomething.org/api/v1/";

    $client = new \GuzzleHttp\Client(['base_url' => $base_url]);

    $this->client = $client;
  }


  public function getCampaign($cid)
  {

    $response = $this->client->get('campaigns/' . $cid);

    return $response->json()['data'];
  }

}