<?php namespace Aurora\Services\MailChimp;

class MailChimpAPI {

  protected $client;

  public function __construct()
  {
    $client = new \Drewm\MailChimp(\Config::get('services.mailchimp.apikey'));

    $this->client = $client;
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
    $this->client->call('lists/subscribe', array(

  ));
  }
}
