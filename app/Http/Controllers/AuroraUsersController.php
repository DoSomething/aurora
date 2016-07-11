<?php

namespace Aurora\Http\Controllers;

use Aurora\Models\AuroraUser;
use DoSomething\Northstar\Northstar;
use Illuminate\Http\Request;

class AuroraUsersController extends Controller
{
    /**
     * Northstar API client.
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
            'admin' => AuroraUser::where('role', 'admin')->get(),
            'staff' => AuroraUser::where('role', 'staff')->get(),
            'intern' => AuroraUser::where('role', 'intern')->get(),

            // Users that have tried to sign in but has no role assigned.
            'unauthorized' => AuroraUser::where('role', '')->get(),
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
     * @param AuroraUser $auroraUser
     * @return \Illuminate\Http\Response
     */
    public function edit(AuroraUser $auroraUser)
    {
        $roles = AuroraUser::allRoles();

        return view('aurora-users.edit')->with(compact('auroraUser', 'roles'));
    }

    /**
     * Update the user's Aurora profile.
     *
     * @param AuroraUser $auroraUser
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(AuroraUser $auroraUser, Request $request)
    {
        $auroraUser->fill($request->all());

        $auroraUser->save();

        return redirect()->route('users.show', [$auroraUser->northstar_id])->with('flash_message', [
            'class' => 'messages',
            'text' => 'Updated!',
        ]);
    }
}
