<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

use Aurora\Services\Drupal\DrupalAPI;
use Aurora\Services\Northstar\NorthstarAPI;
use Aurora\Services\MobileCommons\MobileCommonsAPI;

class User extends Eloquent implements UserInterface, RemindableInterface {

  use UserTrait, RemindableTrait;

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'users';

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = array('remember_token');

  protected $fillable = ['_id'];

  /**
   * This table does not have timestamps.
   */
  public $timestamps = false;

  public function __construct() {
    $this->drupal = new DrupalAPI;
    $this->northstar = new NorthstarAPI;
    $this->mobileCommons = new MobileCommonsAPI;
  }

  /**
   * Define relationship with roles.
   * @return object
   */
  public function roles()
  {
    return $this->belongsToMany('Role');
  }

  /**
   * Assign a specific role to a User.
   */
  public function assignRole($role)
  {
    return $this->roles()->attach($role);
  }


  /**
   * Check to see if User has a Role.
   * @return bool
   */
  public function hasRole($name)
  {
    foreach ($this->roles as $role) {
      if ($role->name === $name) return true;
    }
    return false;
  }

  public function getNorthstarUser($id)
  {
    return $this->northstar->getUser('_id', $id);
  }

  public function getCampaigns($camps)
  {
    $campaigns = [];
    foreach($camps as $campaign){
      if (!empty($campaign['drupal_id'])) {
        array_push($campaigns, $this->drupal->getCampaign($campaign['drupal_id']));
      }
    }
    return $campaigns;
  }


  public function getReportback($reportback, $array)
  {
    array_push($array, $this->drupal->getReportbacks($reportback));
  }







}
