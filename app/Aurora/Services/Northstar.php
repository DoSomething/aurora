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
   * Send a POST request to login the user.
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


  /**
   * Send a GET request to return all users from northstar database
   *
   * @return JSON users
   */
  public function getAllUsers()
  {
    $response = $this->client->get('users');
    return $response->json();
  }


  /**
   * Send a GET request to return a user with that id.
   *
   * @param mixed ID, email, id, phone
   * @return JSON user
   */
  public function getUser($type, $id)
  {
    $response = $this->client->get('users' . '/' .  $type  . '/' . $id);
    return $response->json()['data'][0];
  }


  /**
   * Send a PUT request to update a user
   *
   * @param mixed ID, mixed input
   */
  public function updateUser($id, $input)
  {
    $response = $this->client->put('users' . '/' . $id, [
      'body' => json_encode($input)
    ]);
  }


  /**
   * Send a GET request to return all northstar keys
   *
   * @return JSON keys
   */
  public function getAllApiKeys()
  {
    $response = $this->client->get('keys');
    return $response->json()['data'];
  }


  /**
   * Send a POST request to generate new keys to northstar
   *
   * @param String input
   * @return JSON file
   */
  public function createNewApiKey($input)
  {
    $response = $this->client->post('keys', [
      'body' => json_encode($input),
      ]);
    return $response->json();
  }


  /**
   * Send a GET request to return all users matching $type
   *
   * @todo need to make a parameter for Northstar API's retreive user query to sort by most recent user
   * @param mixed ID, email, id, phone
   * @return user objects
   */
  public function getUsers($type, $id)
  {
    $response = $this->client->get('users' . '/' .  $type  . '/' . $id);
    $northstar_users = $response->json()['data'];
    // sort users by "updated_at" attribute
    uasort($northstar_users, function ($a, $b) {
      if ($a['updated_at'] == $b['updated_at']) {
          return 0;
      }
      return ($a['updated_at'] > $b['updated_at']) ? -1 : 1;
    });
    return $northstar_users;
  }


  /**
   * Send a DELETE request to delete an user from northstar database
   *
   * @param mixed ID
   */
  public function deleteUser($id)
  {
    $response = $this->client->delete('users/' . $id);
  }
}
