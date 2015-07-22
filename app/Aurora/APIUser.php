<?php namespace Aurora;

use Aurora\Services\Drupal\DrupalAPI;
use Aurora\Services\Northstar\NorthstarAPI;
use Aurora\Services\MobileCommons\MobileCommonsAPI;

class APIUser {

  protected $profile;

  public function __construct($profile, DrupalAPI $drupal, MobileCommonsAPI $mobileCommons)
  {
    $this->profile = $profile;

    $this->drupal = $drupal;
    $this->mobileCommons = $mobileCommons;

    // $this->messages = App::make('Aurora\Services\MobileCommons\MobileCommonsAPI')->getMessages();
  }

  public function getProfile() {
    return $this->profile;
  }

  public function getCampaigns() {
    $campaigns = [];
    foreach($this->profile['campaigns'] as $campaign){
      if (!empty($campaign['drupal_id'])) {
        array_push($campaigns, $this->drupal->getCampaignFromDrupal($campaign['drupal_id']));
      }
    }
    return $campaigns;
  }

  public function getReportbacks()
  {
    $reportbacks = [];
    foreach($this->profile['campaigns'] as $campaign){
      if(!empty($campaign["reportback_id"])) {
        array_push($reportbacks, $this->drupal->getReportbacksFromDrupal($campaign['reportback_id']));
      }
    }
    return $reportbacks;
  }

  public function getMobileCommonsProfile()
  {
    return $this->mobileCommons->userProfile($this->profile['mobile']);
  }

  public function getMobileCommonsMessages()
  {
    return $this->mobileCommons->userMessages($this->profile['mobile']);
  }

  public function isAdmin() {
    return AuroraUser::where('_id', $this->id)->first();
  }

}
