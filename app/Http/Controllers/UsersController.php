<?php

namespace Aurora\Http\Controllers;

use DoSomething\Gateway\Resources\NorthstarUser;
use DoSomething\Gateway\Northstar;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

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
        $inputs = array_merge($request->all(), ['pagination' => 'cursor']);
        $users = $this->northstar->getAllUsers($inputs);
        $users->setPaginator(Paginator::class, [
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
        return view('users.show', compact('user'));
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

        $input['email_subscription_topics'] = ! empty($input['email_subscription_topics']) ? $input['email_subscription_topics'] : [];

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

    /**
     * Sends a reset request to NorthstarAPI to send user a password reset email.
     *
     * @param NorthstarUser $user
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function sendPasswordReset(NorthstarUser $user, Request $request)
    {
        $type = $request['type'];

        $this->northstar->sendUserPasswordReset($user->id, $type);

        return redirect()->route('users.show', $user->id)->with('flash_message', ['class' => 'messages', 'text' => 'Sent a '.$type.' email to '.$user->email.'.']);
    }
}
