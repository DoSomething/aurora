<?php

class Role extends Eloquent {

  protected $fillable = ['name'];

  public $timestamps = false;


  /**
   * Get the Users of a specific Role.
   * @return object
   */
  public function users()
  {
    return $this->belongsToMany('User');
  }

  public static function getAllRoleWithAttributes(){
    $roles = Role::all();
    foreach($roles as $role){
      $role_attributes[$role->getAttributes()['id']] = $role->getAttributes()['name'];
    }
    return $role_attributes;
  }

}
