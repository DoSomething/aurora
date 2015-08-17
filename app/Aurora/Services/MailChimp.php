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
    $result = $this->client->call('lists/subscribe', array(
      'id' => $this->testID,
      'email' => ['email' => $email]
    ));
    return $result;
  }

  public function unsubscribe($email)
  {
    // this ID is for "test" users only, production ID for this should be different, can be found in the "lists" function call
    $testID = $this->testID;
    $result = $this->client->call('lists/unsubscribe', array(
      'id' => $testID,
      'email' => ['email' => $email]
    ));
    return $result;
  }
}
