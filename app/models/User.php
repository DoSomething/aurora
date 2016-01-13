<?php

namespace Aurora\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

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
    protected $hidden = ['remember_token'];

    protected $fillable = ['_id'];

    /**
     * This table does not have timestamps.
     */
    public $timestamps = false;

    /**
     * Define relationship with roles.
     *
     * @return object Role
     */
    public function roles()
    {
        return $this->belongsToMany('\Aurora\Models\Role');
    }

    /**
     * Assign a specific role to user.
     *
     * @param object Role or Integer ID
     */
    public function assignRole($role)
    {
        $this->roles()->attach($role);
    }

    /**
     * Remove a specific role from user.
     *
     * @param object Role or Integer ID
     * @return int role ID
     */
    public function removeRole($role)
    {
        return $this->roles()->detach($role);
    }

    /**
     * Check to see if User has a Role.
     *
     * @param string role's name
     * @return bool
     */
    public function hasRole($name)
    {
        foreach ($this->roles as $role) {
            if ($role->name === $name) {
                return true;
            }
        }

        return false;
    }

    /**
     * Used in filters.php
     * @return string
     */
    public function findRole()
    {
        if ($this->roles()->first()) {
            return $this->roles()->first()['name'];
        }

        return;
    }

    /**
     * Used in UsersController
     * @return eloquent collection
     */
    public static function usersWithRole($role)
    {
        $users = static::whereHas('roles', function ($query) use ($role) {
            $query->where('name', $role);
        })->get();

        return $users;
    }
}
