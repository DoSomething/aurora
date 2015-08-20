<?php namespace Aurora\Services\Zendesk;

use GuzzleHttp\Client;

class ZendeskAPI {

  protected $client;

  public function __construct()
  {
    $base_url = \Config::get('services.zendesk.url');

    $username = \Config::get('services.zendesk.username');

    $password = \Config::get('services.zendesk.password');

    $client = new Client([
      'base_url' => $base_url,
      'defaults' => array(
      'auth' => [$username, $password, 'Basic']
      ),
    ]);

    $this->client = $client;
  }

  /**
   * Send a GET request to return a user zendesk profile
   *
   * @param String user email
   * @return JSON user profile
   */
  public function searchByEmail($email)
  {
    $response = $this->client->get('search.json?query=type:user "' . $email . "\"");
    if(isset($response->json()['results']['0'])){
      return $response->json()['results']['0'];
    }
  }


  /**
   * Send a GET request to return a user zendesk tickets
   *
   * @param String zendesk ID
   * @return JSON user tickets
   */
  public function requestedTickets($id)
  {
    $response = $this->client->get('users/' . $id . '/tickets/requested.json' );

    return $response->json();
  }
}
