<?php namespace Aurora\Services\Zendesk;

use GuzzleHttp\Client;

class ZendeskAPI {

  protected $client;

  public function __construct()
  {
    $base_url = \Config::get('services.zendesk.url');

    $username = \Config::get('services.zendesk.username');

    $password = \Config::get('services.zendesk.password');

    $client = new \GuzzleHttp\Client([
      'base_url' => $base_url,
      'defaults' => array(
      'auth' => [$username, $password, 'Basic']
        ),
    ]);

    $this->client = $client;
  }

  public function searchByEmail($email)
  { 
    $response = $this->client->get('search.json?query=type:user "' . $email . "\"");
    if(isset($response->json()['results']['0'])){
      return $response->json()['results']['0'];
    }
  }

  public function requestedTickets($id)
  {

    $response = $this->client->get('users/' . $id . '/tickets/requested.json' );

    return $response->json();
  }
}
