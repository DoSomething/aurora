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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['northstar_id', 'role'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the associated Northstar user.
     */
    public function northstarUser()
    {
        return $this->northstar->getUser('_id', $this->northstar_id);
    }

    /**
     * Check to see if User has a Role.
     *
     * @param string role's name
     * @return bool
     */
    public function hasRole($name)
    {
        return $this->role === $name;
    }

    /**
     * Used in UsersController->show()
     *
     * @return array - all possible values for user roles
     */
    public static function allRoles()
    {
        return [
            null => '--',
            'admin' => 'Administrator',
            'staff' => 'Staff',
            'intern' => 'Intern',
        ];
    }
}
