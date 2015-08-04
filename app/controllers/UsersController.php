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

    //Calling other APIs related to the user.
    $campaigns = $northstar_user->getCampaigns();
    $reportbacks = $northstar_user->getReportbacks();
    $mobile_commons_profile = $northstar_user->getMobileCommonsProfile();

    return View::make('users.show')->with(compact('northstar_profile', 'role', 'campaigns', 'reportbacks', 'mobile_commons_profile'));
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
    $type = Input::get('type');
    if($type === 'Remove staff'){
      $role = 2;
    }elseif($type === 'Remove admin'){
      $role = 1;
    }
    User::where(['_id' => $id])->firstOrFail()->removeRole($role);
    return Redirect::back()->with('flash_message', ['class' => 'messages', 'text' => "User has been removed as ". substr($type, 7)]);
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

  public function RoleCreate($user_id)
  {
    $type = Input::get('type');
    if($type === 'Make staff'){
      $role = 2;
    }elseif($type === 'Make admin'){
      $role = 1;
    }
    // Create a new user in database with type of role
    $user = User::firstOrCreate(['_id' => $user_id])->assignRole($role);
    return Redirect::back()->with('flash_message', ['class' => 'messages', 'text' => 'You assigned that user as ' . substr($type, 5)]);
  }

  public function adminIndex()
  {
    $db_admins = User::whereHas('roles', function($q)
    {
      $q->where('name', 'admin');
    })->get();
    foreach($db_admins as $admin){
      $users[] = $this->northstar->getUser('_id', $admin['_id']);
    }
    return View::make('users.admin-index')->with(compact('users'));
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
