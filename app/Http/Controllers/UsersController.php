<?php

namespace Aurora\Http\Controllers;

use Aurora\NorthstarUser;
use Aurora\Services\Northstar;
use Illuminate\Http\Request;

class UsersController extends Controller
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
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->northstar->getAllUsers($request->all());

        return view('users.index')->with(compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->northstar->getUser('_id', $id);

        // Finding the user assigned roles
        $user_roles = array_pluck($user->getRoles($id), 'name');

        // Getting roles that haven't been assigned to the user
        $unassigned_roles = $user->unassignedRoles($user_roles);

        //Calling other APIs related to the user.
        $campaigns = $user->getCampaigns();
        $reportbacks = $user->getReportbacks();

        return view('users.show')->with(compact('user', 'user_roles', 'unassigned_roles', 'campaigns', 'reportbacks'));
    }

    /**
     * Display the form for editing user information
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->northstar->getUser('_id', $id);

        return view('users.edit')->with(compact('user'));
    }

    /**
     * Making request to NorthstarAPI to update user's information
     *
     * @param string $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $input = $request->except('_token', '_id', 'drupal_uid');

        $this->northstar->updateUser($id, $input);

        return redirect()->route('users.show', $id)->with('flash_message', ['class' => 'messages', 'text' => 'Sweet, look at you updating that user.']);
    }

    /**
     * Remove a role from user in database
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = \Input::get('role');
        $role = \Aurora\Models\Role::where('name', $type)->first();
        \User::where(['_id' => $id])->firstOrFail()->removeRole($role);

        return \Redirect::back()->with('flash_message', ['class' => 'messages', 'text' => "This user's role as ".$type.' has been removed']);
    }

    /**
     * Search users by given input ex. email, mobile, drupal id,
     * first name, last name.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        try {
            $filters = [
                '_id' => $request->query('search'),
                'email' => $request->query('search'),
                'mobile' => $request->query('search'),
            ];

            // Attempt to fetch all users.
            $data = $this->northstar->getAllUsers($filters);
            $inputs = http_build_query($request->all());
            $users = $data['data'];

            if (count($users) === 1) {
                return redirect()->route('users.show', $users[0]['_id']);
            }

            return view('users.index')->with(compact('users', 'data', 'inputs'));
        } catch (\Exception $e) {
            return view('users.index')->with('flash_message', ['class' => 'messages -error', 'text' => 'Looks like there is something wrong with the connection!']);
        }
    }

    /**
     * Assign user to a role
     * @param int User ID, String role name
     *
     * @return Response
     */
    public function roleCreate($id)
    {
        $role = \Input::get('role');
        $roles = ['1' => 'admin', '2' => 'staff', '3' => 'intern'];

        // Create a new user in database with type of role
        $user = \Aurora\Models\User::firstOrCreate(['_id' => $id])->assignRole($role);

        return \Redirect::back()->with('flash_message', ['class' => 'messages', 'text' => 'This user has been assigned a role of '.$roles[$role]]);
    }

    /**
     * Display form to merge duplicate users. Multiple users information is
     * merged into the selected user where blank/different attribute will
     * be filled or overwritten by the selected keep user.
     *
     * @return Response
     */
    public function mergedForm()
    {
        $inputs = \Input::all();
        $keep_id = $inputs['keep'];
        $delete_ids = $inputs['delete'];
        $keep_user = $this->northstar->getUser('_id', $keep_id);
        $user = [];
        foreach ($delete_ids as $delete_id) {
            $delete_user = $this->northstar->getUser('_id', $delete_id);
            $user = array_merge($user, array_filter($delete_user), array_filter($keep_user));
        }

        return \View::make('search.merge-and-delete-form')->with(compact('user'));
    }

    /**
     * Making request to NorthstarAPI to delete users marked
     * for deletion from duplication form
     */
    public function deleteUnmergedUsers()
    {
        $inputs = \Input::all();
        $delete_ids = $inputs['delete'];
        foreach ($delete_ids as $id) {
            $this->northstar->deleteUser($id);
        }
    }
}
