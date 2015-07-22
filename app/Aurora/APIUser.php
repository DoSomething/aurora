<?php namespace Aurora;

use Aurora\Services\Drupal\DrupalAPI;
use Aurora\Services\Northstar\NorthstarAPI;
use Aurora\Services\MobileCommons\MobileCommonsAPI;

class APIUser {

  protected $data;

  function __construct($profile, DrupalAPI $drupal, NorthstarAPI $northstar, MobileCommonsAPI $mobileCommons)
  {
    $this->profile = $profile;

    $this->drupal = $drupal;
    $this->northstar = $northstar;
    $this->mobileCommons = $mobileCommons;

    // $this->messages = App::make('Aurora\Services\MobileCommons\MobileCommonsAPI')->getMessages();
  }

  function getProfile() {
    return $this->profile;
  }

  function getCampaigns() {
    foreach($this->data['campaigns'] as $campaign){
      if (!empty($campaign['drupal_id'])) {
        array_push($campaigns, $this->drupal->getCampaign($campaign['drupal_id']));
        if (!empty($campaign['reportback_id'])) {
          $user->getReportback($campaign['reportback_id'], $reportbacks);
        }
      }
    }
  }

  function getSmsProfile()
  {
    return $this->mobileCommons->userProfile($user['mobile']);
  }

  function getSmsMessages()
  {
    return $this->mobileCommons->userMessages($user['mobile']);
  }

  function isAdmin() {
    return AuroraUser::where('_id', $this->id)->first();
  }

}
