<?php namespace Aurora\Services\Northstar;

class NorthstarAPI {

  protected $client;

  public function __construct()
  {
    $base_url = \Config::get('services.northstar.url');

    if (\App::environment('local')) {
      $base_url .=  ":" . \Config::get('services.northstar.port');
    }
    $version = \Config::get('services.northstar.version');

    $client = new \GuzzleHttp\Client([
      'base_url' => [$base_url . '/{version}/', ['version' => $version]],
      'defaults' => array(
        'headers' => [
          'X-DS-Application-Id' => \Config::get('services.northstar.app_id') ,
          'X-DS-REST-API-Key' => \Config::get('services.northstar.api_key'),
          'Content-Type' => 'application/json',
          'Accept' => 'application/json'
          ]
        ),
    ]);
    $this->client = $client;
  }

  /**
   * Sends a post request to login the user.
   *
   * @param array - input
   *
   */
  public function login($input)
  {
    $response = $this->client->post('login', [
      'body' => json_encode($input)
    ]);
    return $response->json()['data'];
  }

  public function getAllUsers($input)
  {
    $response = $this->client->get('users', [
      'query' => $input
    ]);

    return $response->json();

  }
  /**
   * Sends a get request to return a user with that id.
   *
   * @param mixed ID, email, id, phone
   * @return user object
   */
  public function getUser($type, $id)
  {
    $response = $this->client->get('users' . '/' .  $type  . '/' . $id);
    return $response->json()['data'][0];
  }

  public function updateUser($id, $input)
  {
    $response = $this->client->put('users' . '/' . $id, [
      'body' => json_encode($input)
    ]);
  }

  public function getAllApiKeys()
  {
    $response = $this->client->get('keys');
    return $response->json()['data'];
  }

  public function createNewApiKey($input)
  {
    $response = $this->client->post('keys', [
      'body' => json_encode($input),
      ]);
    return $response->json();
  }
  // used in the search action of the users controller for the sake of duplicate users
  public function getUsers($type, $id)
  {
    $response = $this->client->get('users' . '/' .  $type  . '/' . $id);
    $northstar_users = $response->json()['data'];
    uasort($northstar_users, function ($a, $b) {
      if ($a['updated_at'] == $b['updated_at']) {
          return 0;
      }
      return ($a['updated_at'] > $b['updated_at']) ? -1 : 1;
    });
    return $northstar_users;
  }
}
