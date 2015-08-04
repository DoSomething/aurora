<?php

use Aurora\NorthstarUser;
use Aurora\Services\Northstar\NorthstarAPI;
use Illuminate\Support\Facades\Input;

class UsersController extends \BaseController {

  public function __construct(NorthstarAPI $northstar) {
    $this->beforeFilter('auth');
    $this->beforeFilter('roles');
    $this->beforeFilter('role:admin', ['only' =>['edit', 'update', 'destroy', 'adminCreate', 'adminIndex']]);
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
    $northstar_user = new NorthstarUser($id);
    $role = $northstar_user->getRole($id); //Finding for the user role
    $northstar_profile = $northstar_user->profile;
    // $roles = array_map('strtoupper', (Role::all()->lists('name')));

    $roles = array('1' => 'admin', '2' => 'staff', '3' => 'intern');
    // list all roles for a user minus roles already given
    unset($roles[array_search($role, $roles)]);
    $roles = array_map('strtoupper', $roles);
    //Calling other APIs related to the user.
    $campaigns = $northstar_user->getCampaigns();
    $reportbacks = $northstar_user->getReportbacks();
    $mobile_commons_profile = $northstar_user->getMobileCommonsProfile();

    return View::make('users.show')->with(compact('northstar_profile', 'role', 'campaigns', 'reportbacks', 'mobile_commons_profile', 'roles'));
  }

  public function mobileCommonsMessages($id)
  {
    $northstar_user = new NorthstarUser($id);

    $mobile_commons_messages = $northstar_user->getMobileCommonsMessages();

    return View::make('users.mobile-commons-messages')->with(compact('mobile_commons_messages'));
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

  public function adminIndex()
  {
    $admins = [];
    $staffs = [];
    $interns = [];
    $unassigned = [];

    $db_admins = User::whereHas('roles', function($query)
    {
      $query->where('name', 'admin');
    })->get();

    $db_staffs = User::whereHas('roles', function($query)
    {
      $query->where('name', 'staff');
    })->get();

    $db_interns = User::whereHas('roles', function($query)
    {
      $query->where('name', 'intern');
    })->get();

    $db_unassigned = DB::select('select * from users left join role_user on users.id = role_user.user_id where role_user.user_id is NULL');

    foreach($db_admins as $admin){
      $admins[] = $this->northstar->getUser('_id', $admin['_id']);
    }

    foreach($db_staffs as $staff){
      $staffs[] = $this->northstar->getUser('_id', $staff['_id']);
    }

    foreach($db_interns as $intern){
      $interns[] = $this->northstar->getUser('_id', $intern['_id']);
    }

    foreach($db_unassigned as $nonmember){
      $unassigned[] = $this->northstar->getUser('_id', $nonmember->_id);
    }

    return View::make('users.admin-index')->with(compact('admins', 'staffs', 'interns', 'unassigned'));
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
