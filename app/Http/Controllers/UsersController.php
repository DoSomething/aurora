<?php

namespace Aurora\Http\Controllers;

use Aurora\NorthstarUser;
use Aurora\Services\Northstar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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
        try {
            // Attempt to fetch all users.
            $data = $this->northstar->getAllUsers($request->all());
            $inputs = http_build_query($request->all());
            $users = $data['data'];

            return \View::make('users.index')->with(compact('users', 'data', 'inputs'));
        } catch (\Exception $e) {
            return \View::make('users.index')->with('flash_message', ['class' => 'messages -error', 'text' => 'Looks like there is something wrong with the connection!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return Response
     */
    public function show($id)
    {
        // Finding the user in nortstar DB and getting the informations
        $northstar_user = new NorthstarUser($id);
        $northstar_profile = $northstar_user->profile;
        // Finding the user assigned roles
        $user_roles = array_pluck($northstar_user->getRoles($id), 'name');

        // Getting roles that haven't been assigned to the user
        $unassigned_roles = $northstar_user->unassignedRoles($user_roles);

        //Calling other APIs related to the user.
        $campaigns = $northstar_user->getCampaigns();
        $reportbacks = $northstar_user->getReportbacks();

        return \View::make('users.show')->with(compact('northstar_profile', 'user_roles', 'unassigned_roles', 'campaigns', 'reportbacks', 'mobile_commons_profile', 'zendesk_profile', 'mailchimp_list_id'));
    }

    /**
     * Display user's mobile commons messages
     *
     * @param  string  $id
     * @return Response
     */
    public function mobileCommonsMessages($id)
    {
        $northstar_user = new NorthstarUser($id);

        $mobile_commons_messages = $northstar_user->getMobileCommonsMessages();

        return \View::make('users.mobile-commons-messages')->with(compact('mobile_commons_messages'));
    }

    /**
     * Display user's zendesk tickets
     *
     * @param  string  $id
     * @return Response
     */
    public function zendeskTickets($id)
    {
        $northstar_user = new NorthstarUser($id);

        $requested_tickets = $northstar_user->zendeskRequestedTickets();

        return \View::make('users.zendesk-tickets')->with(compact('requested_tickets'));
    }

    /**
     * Display the form for editing user information
     *
     * @param  string  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->northstar->getUser('_id', $id);

        return \View::make('users.edit')->with(compact('user'));
    }

    /**
     * Making request to NorthstarAPI to update user's information
     *
     * @param  string  $id
     * @return Response
     */
    public function update($id)
    {
        $input = \Input::except('_token', '_id', 'drupal_uid');
        $user = $this->northstar->updateUser($id, $input);

        return \Redirect::route('users.show', $id)->with('flash_message', ['class' => 'messages', 'text' => 'Sweet, look at you updating that user.']);
    }

    /**
     * Remove a role from user in database
     *
     * @param  string  $id
     * @return Response
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
            return \View::make('users.index')->with('flash_message', ['class' => 'messages -error', 'text' => 'Looks like there is something wrong with the connection!']);
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
     * Display Users roles
     *
     * @return Response
     */
    public function staffIndex()
    {
        $employee['admin'] = \Aurora\Models\User::usersWithRole('admin');

        $employee['staff'] = \Aurora\Models\User::usersWithRole('staff');

        $employee['intern'] = \Aurora\Models\User::usersWithRole('intern');
        // users that tried to sign in but has no role or unauthorized
        $employee['unassigned'] = \Aurora\Models\User::leftJoin('role_user', 'users.id', '=', 'role_user.user_id')->whereNull('role_user.user_id')->get();

        foreach ($employee as $role => $users) {
            foreach ($users as $user) {
                $group[$role][] = $this->northstar->getUser('_id', $user['_id']);
            }
        }

        return \View::make('users.staff-index')->with(compact('group'));
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

    /**
     * Making request to MailChimp to unsubscribe
     * @TODO implement unsubscribe to Mobile Commons, Drupal and Message Broker
     */
    public function unsubscribeFromMailChimp($northstar_id)
    {
        $mailchimp_list_id = Input::get('mailchimp_list_id');
        $northstar_user = new NorthstarUser($northstar_id);
        $northstar_user->mailChimpUnsubscribe($mailchimp_list_id);

        return \Redirect::back()->with('flash_message', ['class' => 'messages', 'text' => 'This user has been unsubscribed from MailChimp!']);
    }
}
