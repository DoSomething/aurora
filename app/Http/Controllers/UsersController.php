<?php

namespace Aurora\Http\Controllers;

use Aurora\Models\AuroraUser;
use DoSomething\Northstar\Resources\NorthstarUser;
use DoSomething\Northstar\Northstar;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class UsersController extends Controller
{
    /**
     * The Northstar API client.
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
        $users->setPaginator(LengthAwarePaginator::class, [
            'path' => 'users',
        ]);

        return view('users.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param NorthstarUser $user
     * @return \Illuminate\Http\Response
     */
    public function show(NorthstarUser $user)
    {
        $auroraUser = AuroraUser::where('northstar_id', $user->id)->first();

        return view('users.show', compact('user', 'auroraUser'));
    }

    /**
     * Display the form for editing user information
     *
     * @param NorthstarUser $user
     * @return \Illuminate\Http\Response
     */
    public function edit(NorthstarUser $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Making request to NorthstarAPI to update user's information
     *
     * @param NorthstarUser $user
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(NorthstarUser $user, Request $request)
    {
        $input = $request->except('_token', '_id', 'drupal_uid');
        $this->northstar->updateUser($user->id, $input);

        return redirect()->route('users.show', $user->id)->with('flash_message', ['class' => 'messages', 'text' => 'Sweet, look at you updating that user.']);
    }

    /**
     * Delete a user from Northstar.
     *
     * @param NorthstarUser $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(NorthstarUser $user)
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
        $users = $this->northstar->getAllUsers([
            'search' => [
                '_id' => $query,
                'drupal_id' => $query,
                'email' => $query,
                'mobile' => $query,
            ],
            'page' => $request->query('page', 1),
        ]);

        $users->setPaginator(LengthAwarePaginator::class, [
            'path' => 'users',
        ]);

        // If only one user is matched, let's just redirect there.
        if ($users->total() === 1) {
            return redirect()->route('users.show', [$users->first()->id]);
        }

        return view('users.search', compact('users', 'query'));
    }
}
