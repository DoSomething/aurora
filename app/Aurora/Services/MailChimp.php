<?php namespace Aurora\Services\MailChimp;

class MailChimpAPI {

  protected $client;
  protected $testID;

  public function __construct()
  {
    // this ID is for "test" users only
    $this->testID = \Config::get('services.mailchimp.test_id');
    // international members
    $this->internationalID = \Config::get('services.mailchimp.international_id');
    // regular dosomething members
    $this->domesticID = \Config::get('services.mailchimp.domestic_id');
    // 26+ club members
    $this->dinosaurID = \Config::get('services.mailchimp.dinosaur_id');
    $this->client = new \Drewm\MailChimp(\Config::get('services.mailchimp.apikey'));
  }

  public function unsubscribe($email, $id)
  {
    $response = $this->client->call('lists/unsubscribe', array(
      'id' => $id,
      'email' => ['email' => $email]
    ));
    return $response;
  }

  public function listFinder($email)
  {
    $list_ids = [$this->domesticID, $this->internationalID, $this->dinosaurID, $this->testID];
    foreach($list_ids as $id) {
      $response = $this->client->call('lists/member-info', array('id' => $id, 'emails' => [["email" => $email]] ));
      if (empty($response['errors'])) {
        if ($response['data'][0]['status'] == 'unsubscribed'){
          return [];
        } else {
          return $id;
        }
      }
    }
    return [];
  }
}
