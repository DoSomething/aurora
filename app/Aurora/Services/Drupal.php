<?php namespace Aurora\Services\Drupal;

class DrupalAPI {

  public function getCampaigns()
  {
    $client = new \Guzzle\Service\Client("https://www.dosomething.org");
    $response = $client->get('/api/v1/campaigns/362')->send();

    return $response->json()['data'];
  }

}