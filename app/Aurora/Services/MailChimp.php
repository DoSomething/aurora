<?php namespace Aurora\Services\MailChimp;

use Drewm\MailChimp;

class MailChimpAPI {

  protected $client;
  protected $testID;

  public function __construct()
  {
    // for "test" users only
    $this->testID = config('services.mailchimp.test_id');
    // international members
    $this->internationalID = config('services.mailchimp.international_id');
    // regular dosomething members
    $this->domesticID = config('services.mailchimp.domestic_id');
    // 26+ club members
    $this->dinosaurID = config('services.mailchimp.dinosaur_id');
    $this->client = new MailChimp(config('services.mailchimp.apikey'));
  }

  public function unsubscribe($email, $list_id)
  {
    $response = $this->client->call('lists/unsubscribe', array(
      'id' => $list_id,
      'email' => ['email' => $email]
    ));
    return $response;
  }

  public function listFinder($email)
  {
    $list_ids = [$this->domesticID, $this->internationalID, $this->dinosaurID, $this->testID];
    foreach ($list_ids as $list_id) {
      $response = $this->client->call('lists/member-info', array('id' => $list_id, 'emails' => [["email" => $email]] ));
      if (empty($response['errors'])) {
        if ($response['data'][0]['status'] == 'subscribed'){
          return $list_id;
        }
      }
    }
    return [];
  }
}
