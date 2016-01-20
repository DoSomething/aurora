<?php

namespace Aurora\Http\Controllers;

use Aurora\Models\User;
use Aurora\Services\Northstar;

class AuroraUsersController extends Controller
{
    /**
     * @var Northstar
     */
    protected $northstar;

    public function __construct(Northstar $northstar)
    {
        $this->northstar = $northstar;

        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee['admin'] = User::usersWithRole('admin');

        $employee['staff'] = User::usersWithRole('staff');

        $employee['intern'] = User::usersWithRole('intern');
        // users that tried to sign in but has no role or unauthorized
        $employee['unassigned'] = User::leftJoin('role_user', 'users.id', '=', 'role_user.user_id')->whereNull('role_user.user_id')->get();

        foreach ($employee as $role => $users) {
            foreach ($users as $user) {
                $group[$role][] = $this->northstar->getUser('_id', $user['_id']);
            }
        }

        return \View::make('aurora-users.index')->with(compact('group'));
    }
}
