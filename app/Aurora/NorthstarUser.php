<?php namespace Aurora;

use Aurora\Services\Drupal\DrupalAPI;
use Aurora\Services\Northstar\NorthstarAPI;
use Aurora\Services\MobileCommons\MobileCommonsAPI;

class NorthstarUser {

  public function __construct($id, NorthstarAPI $northstar, DrupalAPI $drupal, MobileCommonsAPI $mobileCommons)
  {
    $this->northstar = $northstar;
    $this->drupal = $drupal;
    $this->mobileCommons = $mobileCommons;
    $this->profile = $this->northstar->getUser('_id', $id);
  }

  public function getCampaigns() {
    $campaigns = [];
    $profile = $this->profile;

    if(isset($profile['campaigns'])){
      foreach($profile['campaigns'] as $campaign){
        if (isset($campaign['drupal_id'])) {
          array_push($campaigns, $this->drupal->getCampaignFromDrupal($campaign['drupal_id']));
        }
      }
    }
    return array_filter($campaigns);
  }

  public function getReportbacks()
  {
    $reportbacks = [];
    $profile = $this->profile;
    if(isset($profile['campaigns'])){
      foreach($profile['campaigns'] as $campaign){
        if(isset($campaign["reportback_id"])) {
          array_push($reportbacks, $this->drupal->getReportbacksFromDrupal($campaign['reportback_id']));
        }
      }
    }
    return array_filter($reportbacks);
  }

  public function getMobileCommonsProfile()
  {
    if(isset($this->profile['mobile']))
    {
      return $this->mobileCommons->userProfile($this->profile['mobile']);
    }
  }

  public function getMobileCommonsMessages()
  {
    return $this->mobileCommons->userMessages($this->profile['mobile']);
  }

  public function isAdmin() {
    return AuroraUser::where('_id', $this->id)->first();
  }

}
