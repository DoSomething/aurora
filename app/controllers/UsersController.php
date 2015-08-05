<?php

use Aurora\NorthstarUser;
use Aurora\Services\Northstar\NorthstarAPI;
use Illuminate\Support\Facades\Input;

class UsersController extends \BaseController {

  public function __construct(NorthstarAPI $northstar) {
    $this->beforeFilter('auth');
    $this->beforeFilter('roles');
    $this->beforeFilter('intern', ['only'=>['edit', 'update', 'mobileCommonsMessages', 'zendeskTickets']]);
    $this->beforeFilter('notAdmin', ['only' =>['destroy', 'roleCreate', 'staffIndex', 'deleteUnmergedUsers' ]]);
    $this->northstar = $northstar;
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    try {
      // Attempt to fetch all users.
      $input = Input::all();
      $data = $this->northstar->getAllUsers($input);
      $users = $data['data'];
      return View::make('users.index')->with(compact('users', 'data'));
    } catch (Exception $e) {
      return View::make('users.index')->with('flash_message', ['class' => 'messages -error', 'text' => 'Looks like there is something wrong with the connection!']);
    }
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    //
  }


  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    //
  }


  /**
   * Display the specified resource.
   *
   * @param  int  $id
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
    $mobile_commons_profile = $northstar_user->getMobileCommonsProfile();
    $zendesk_profile = $northstar_user->searchZendeskUserByEmail();
    return View::make('users.show')->with(compact('northstar_profile', 'user_roles', 'unassigned_roles', 'campaigns', 'reportbacks', 'mobile_commons_profile', 'zendesk_profile'));
  }

  public function mobileCommonsMessages($id)
  {
    $northstar_user = new NorthstarUser($id);

    $mobile_commons_messages = $northstar_user->getMobileCommonsMessages();

    return View::make('users.mobile-commons-messages')->with(compact('mobile_commons_messages'));
  }

  public function zendeskTickets($id)
  {
    $northstar_user = new NorthstarUser($id);

    $requested_tickets = $northstar_user->zendeskRequestedTickets();

    return View::make('users.zendesk-tickets')->with(compact('requested_tickets'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $user = $this->northstar->getUser('_id', $id);
    return View::make('users.edit')->with(compact('user'));
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    $input = Input::except('_token', '_id', 'drupal_uid');
    $user = $this->northstar->updateUser($id, $input);
    return Redirect::route('users.show', $id)->with('flash_message', ['class' => 'messages', 'text' => 'Sweet, look at you updating that user.']);
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $type = Input::get('role');
    $role = Role::where('name', $type)->first();
    User::where(['_id' => $id])->firstOrFail()->removeRole($role);
    return Redirect::back()->with('flash_message', ['class' => 'messages', 'text' => "This user's role as " . $type . " has been removed"]);
  }

  public function search()
  {
    $search = Input::get('search_by');
    $type = strtolower(str_replace(' ', '_', Input::get('type')));
    try {
      // Attempt to find the user.
      $northstar_users = $this->northstar->getUsers($type, $search);
      if (count($northstar_users) > 1){
        return View::make('search.results')->with(compact('northstar_users'));
      } else {
        return Redirect::route('users.show', $northstar_users[0]['_id']);
      }
    } catch (Exception $e) {
      return Redirect::back()->withInput()->with('flash_message', ['class' => 'messages -error', 'text' => 'Hmm, couldn\'t find anyone, are you sure thats right?']);
    }
  }

  public function roleCreate($id)
  {
    $role = Input::get('role');
    $roles = array('1' => 'admin', '2' => 'staff', '3' => 'intern');

    // Create a new user in database with type of role
    $user = User::firstOrCreate(['_id' => $id])->assignRole($role);
    return Redirect::back()->with('flash_message', ['class' => 'messages', 'text' => 'This user has been assigned a role of ' . $roles[$role]]);
  }

  public function staffIndex()
  {
    $employee['admin'] = User::usersWithRole('admin');

    $employee['staff'] = User::usersWithRole('staff');

    $employee['intern'] = User::usersWithRole('intern');

    // users that tried to sign in but has no role or unauthorized
    $employee['unassigned'] = DB::select('select * from users left join role_user on users.id = role_user.user_id where role_user.user_id is NULL');

    foreach($employee as $role => $users){
      foreach($users as $user){
        if ($role == 'unassigned') {
          $group[$role][] = $this->northstar->getUser('_id', $user->_id);
        } else {
        $group[$role][] = $this->northstar->getUser('_id', $user['_id']);
        }
      }
    }
    return View::make('users.staff-index')->with(compact('group'));
  }

  public function mergedForm()
  {
    $inputs = Input::all();
    $keep_id =  $inputs['keep'];
    $delete_ids = $inputs['delete'];
    $keep_user = $this->northstar->getUser('_id', $keep_id);
    $user = [];
    foreach($delete_ids as $delete_id){
      $delete_user = $this->northstar->getUser('_id', $delete_id);
      $user = array_merge($user, $delete_user, $keep_user);
    }
    return View::make('search.merge-and-delete-form')->with(compact('user'));
  }

  public function deleteUnmergedUsers()
  {
    $inputs = Input::all();
    $delete_ids = $inputs['delete'];
    foreach($delete_ids as $id){
      $this->northstar->deleteUser($id);
    }
  }
}
