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
   *
   * @return Object Role
   */
  public function roles()
  {
    return $this->belongsToMany('Role');
  }


  /**
   * Assign a specific role to user.
   *
   * @param Object Role or Integer ID
   */
  public function assignRole($role)
  {
    $this->roles()->attach($role);
  }


  /**
   * Remove a specific role from user.
   *
   * @param Object Role or Integer ID
   * @return Integer role ID
   */
  public function removeRole($role)
  {
    return $this->roles()->detach($role);
  }

  /**
   * Check to see if User has a Role.
   *
   * @param String role's name
   * @return boolean
   */
  public function hasRole($name)
  {
    foreach ($this->roles as $role) {
      if ($role->name === $name) return true;
    }
    return false;
  }
  /**
   * Used in filters.php
   * @return string
   */
  public function findRole() {
    if($this->roles()->first()){
      return $this->roles()->first()['name'];
    }
    return NULL;
  }
  /**
   * Used in UsersController
   * @return eloquent collection
   */
  public static function usersWithRole($role)
  {
    $users = User::whereHas('roles', function($query) use($role){
      $query->where('name', $role);
    })->get();
    return $users;
  }

}
