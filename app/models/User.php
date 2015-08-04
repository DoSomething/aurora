<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

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

  public function removeRole($role)
  {
    return $this->roles()->detach($role);
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

  public function findRole() {
    if($this->hasRole('admin')) return "admin";
    elseif($this->hasRole('staff')) return "staff";
    elseif ($this->hasRole('intern')) return "intern";
    else return 'no role';
  }

}
