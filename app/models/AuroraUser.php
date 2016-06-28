<?php

namespace Aurora\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

/**
 * Class AuroraUser
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AuroraUser find(string $id, array $columns)
 * @method static \Illuminate\Database\Eloquent\Builder|AuroraUser firstOrCreate(array $attributes)
 * @method static \Illuminate\Database\Eloquent\Builder|AuroraUser where(string $field, string $comparison = '=', string $value)
 */
class AuroraUser extends Model implements AuthenticatableContract
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
        return app('\Aurora\Services\Northstar')->getUser('_id', $this->northstar_id);
    }

    /**
     * Check to see if this user matches one of the given roles.
     *
     * @param  array|mixed $roles - role(s) to check
     * @return bool
     */
    public function hasRole($roles)
    {
        // Prepare an array of roles to check.
        // e.g. $user->hasRole('admin') => ['admin']
        //      $user->hasRole('admin, 'staff') => ['admin', 'staff']
        $roles = is_array($roles) ? $roles : func_get_args();

        return in_array($this->role, $roles);
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
