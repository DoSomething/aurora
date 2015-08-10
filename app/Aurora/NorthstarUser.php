<?php namespace Aurora;

use App;
use Aurora\Services\Drupal\DrupalAPI;
use Aurora\Services\Northstar\NorthstarAPI;
use Aurora\Services\MobileCommons\MobileCommonsAPI;
use Aurora\Services\Zendesk\ZendeskAPI;

class NorthstarUser {

  public function __construct($id)
  {
    $this->northstar = App::make('Aurora\Services\Northstar\NorthstarAPI');
    $this->drupal = App::make('Aurora\Services\Drupal\DrupalAPI');
    $this->mobileCommons = App::make('Aurora\Services\MobileCommons\MobileCommonsAPI');
    $this->zendesk = App::make('Aurora\Services\Zendesk\ZendeskAPI');
    $this->profile = $this->northstar->getUser('_id', $id);
  }


  /**
   * Get all user's campaigns
   *
   * @return Array user's campaigns
   */
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


  /**
   * Get all user's reportbacks
   *
   * @return Array user's reportbacks
   */
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


  /**
   * Get user's mobile commons profile
   *
   * @return Array user's mobile commons profile
   */
  public function getMobileCommonsProfile()
  {
    if(isset($this->profile['mobile']))
    {
      return $this->mobileCommons->userProfile($this->profile['mobile']);
    }
  }


  /**
   * Get all user's mobile commons message backlogs
   *
   * @return Array user's mobile commons message backlogs
   */
  public function getMobileCommonsMessages()
  {
    return $this->mobileCommons->userMessages($this->profile['mobile']);
  }


  /**
   * Get user's zendesk profile
   *
   * @return Array user's zendesk profile infomation
   */
  public function searchZendeskUserByEmail()
  {
    return $this->zendesk->searchByEmail($this->profile['email']);
  }


  /**
   * Get user's zendesk tickets
   *
   * @return Array user's zendesk tickets
   */
  public function zendeskRequestedTickets()
  {
    $zendeskID = $this->zendesk->searchByEmail($this->profile['email'])['id'];

    return $this->zendesk->requestedTickets($zendeskID)['tickets'];
  }


  /**
   * Used in UsersController->show()
   *
   * @var array of roles this user has
   */
  public function getRoles($id) {
    $roles = [];
    $user = \User::where('_id', $id)->first();
    if(!empty($user)){
      foreach ($user->roles as $role) {
        $roles[] = $role->getAttributes();
      }
    }
    return $roles;
  }

  /**
   * Used in UsersController->show()
   *
   * @var array of roles this user doesnt have
   */
  public function unassignedRoles($user_roles) {
    $all_roles = ['1' => 'admin', '2' => 'staff', '3' => 'intern'];
    $unassigned_roles = array_diff($all_roles, $user_roles);
    if (!in_array('staff', $unassigned_roles)){
      $unassigned_roles = ['1' => 'ADMIN'];
    }
    foreach($unassigned_roles as $key => $value){
      $unassigned_roles[$key] = ucfirst($value);
    }
    return $unassigned_roles;
  }

}
