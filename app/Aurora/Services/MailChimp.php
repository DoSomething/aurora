<?php namespace Aurora\Services\MailChimp;

class MailChimpAPI {

  protected $client;
  protected $testID;

  public function __construct()
  {
    $this->testID = \Config::get('services.mailchimp.list_id');
    $this->client = new \Drewm\MailChimp(\Config::get('services.mailchimp.apikey'));
  }

  /**
   * Send a GET request to return a user mailchimp profile
   * @return array of Mail Chimp lists
   */
  public function lists()
  {
    $response = $this->client->call('lists/list');
    return $response['data'];
  }

  public function subscribe($email)
  {
    $testID = $this->testID;
    $response = $this->client->call('lists/subscribe', array(
      'id' => $testID,
      'email' => ['email' => $email]
    ));
    return $response;
  }

  public function unsubscribe($email)
  {
    // this ID is for "test" users only, production ID for this should be different, can be found in the "lists" function call
    $testID = $this->testID;
    $response = $this->client->call('lists/unsubscribe', array(
      'id' => $testID,
      'email' => ['email' => $email]
    ));
    return $response;
  }

  public function memberInfo($email)
  {
    // this ID is for "test" users only, production ID for this should be different, can be found in the "lists" function call
    $testID = $this->testID;
    $response = $this->client->call('lists/member-info', array(
      'id' => $testID,
      'emails' => [["email" => $email]]
    ));
    if (!empty($response['errors'])) { // check if user exists in database
      // empty array, error message is available if needed
      return $response['data'];
    } else if ($response['data'][0]['status'] == 'unsubscribed') { // check if user is unsubsrcibed
      return [];
    } else { // user exists and is subscribed
      // empty array
      return $response['data'];
    }
  }
}
