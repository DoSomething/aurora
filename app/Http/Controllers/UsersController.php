<?php

namespace Aurora\Http\Controllers;

use Aurora\Models\User;
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
        $this->middleware('role:admin,staff,intern');
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
        $auroraUser = User::where('northstar_id', $user->id)->first();

        //Calling other APIs related to the user.
        $campaigns = $user->getCampaigns();
        $reportbacks = $user->getReportbacks();

        return view('users.show')->with(compact('user', 'auroraUser', 'campaigns', 'reportbacks'));
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
     * Delete a user from Northstar.
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // @TODO!
        return redirect()->back()->with('flash_message', ['class' => 'messages', 'text' => 'Not yet implemented.']);
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
        $query = $request->query('query');

        // Redirect empty queries to the user index.
        if ($query === '') {
            return redirect()->route('users.index');
        }

        // Attempt to fetch all users.
        $users = $this->northstar->getAllUsers(['search' => [
            '_id' => $query,
            'email' => $query,
            'mobile' => $query,
        ]]);

        // If only one user is matched, let's just redirect there.
        if ($users->total() === 1) {
            return redirect()->route('users.show', [$users->first()->id]);
        }

        return view('users.search')->with(compact('users', 'query'));
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
