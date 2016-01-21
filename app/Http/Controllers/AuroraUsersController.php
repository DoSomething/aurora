<?php

namespace Aurora\Http\Controllers;

use Aurora\Models\User;
use Aurora\Services\Northstar;
use Illuminate\Http\Request;

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
        $users = [
            'admin' => User::where('role', 'admin')->get(),
            'staff' => User::where('role', 'staff')->get(),
            'intern' => User::where('role', 'intern')->get(),

            // Users that have tried to sign in but has no role assigned.
            'unauthorized' => User::where('role', '')->get(),
        ];

        foreach ($users as $role => $subsetUsers) {
            foreach ($subsetUsers as $user) {
                $group[$role][] = $this->northstar->getUser('_id', $user->northstar_id);
            }
        }

        return view('aurora-users.index')->with(compact('group'));
    }

    /**
     * Display the form for editing user information
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $auroraUser = User::where('id', $id)->firstOrFail();

        // Get the list of all roles
        $roles = User::allRoles();

        return view('aurora-users.edit')->with(compact('auroraUser', 'roles'));
    }

    /**
     * Update the user's Aurora profile.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $auroraUser = User::where('id', $id)->firstOrFail();
        $auroraUser->fill($request->all());

        $auroraUser->save();

        return redirect()->route('users.show', [$auroraUser->northstar_id])->with('flash_message', [
            'class' => 'messages',
            'text' => 'Updated!',
        ]);
    }
}