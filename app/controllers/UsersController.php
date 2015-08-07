<?php

use Aurora\NorthstarUser;
use Aurora\Services\Northstar\NorthstarAPI;
use Illuminate\Support\Facades\Input;

class UsersController extends \BaseController {

  public function __construct(NorthstarAPI $northstar) {
    $this->beforeFilter('auth');
    $this->beforeFilter('role:admin');
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
      $data = $this->northstar->getAllUsers();
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
   * @param  String  $id
   * @return Response
   */
  public function show($id)
  {
    $northstar_user = new NorthstarUser($id);
    $aurora_user = $northstar_user->isAdmin($id); //Checking if user is admin.
    $northstar_profile = $northstar_user->profile;
    //Calling other APIs related to the user.
    $campaigns = $northstar_user->getCampaigns();
    $reportbacks = $northstar_user->getReportbacks();
    $mobile_commons_profile = $northstar_user->getMobileCommonsProfile();
    $zendesk_profile = $northstar_user->searchZendeskUserByEmail();


    return View::make('users.show')->with(compact('northstar_profile', 'aurora_user', 'campaigns', 'reportbacks', 'mobile_commons_profile', 'zendesk_profile'));
  }

  /**
   * Display user's mobile commons messages
   *
   * @param  String  $id
   * @return Response
   */
  public function mobileCommonsMessages($id)
  {
    $northstar_user = new NorthstarUser($id);

    $mobile_commons_messages = $northstar_user->getMobileCommonsMessages();

    return View::make('users.mobile-commons-messages')->with(compact('mobile_commons_messages'));
  }


  /**
   * Display user's zendesk tickets
   *
   * @param  String  $id
   * @return Response
   */
  public function zendeskTickets($id)
  {
    $northstar_user = new NorthstarUser($id);

    $requested_tickets = $northstar_user->zendeskRequestedTickets();

    return View::make('users.zendesk-tickets')->with(compact('requested_tickets'));
  }

  /**
   * Display the form for editing user information
   *
   * @param  String  $id
   * @return Response
   */
  public function edit($id)
  {
    $user = $this->northstar->getUser('_id', $id);
    return View::make('users.edit')->with(compact('user'));
  }


  /**
   * Making request to NorthstarAPI to update user's information
   *
   * @param  String  $id
   * @return Response
   */
  public function update($id)
  {
    $input = Input::except('_token', '_id', 'drupal_uid');
    $user = $this->northstar->updateUser($id, $input);
    return Redirect::route('users.show', $id)->with('flash_message', ['class' => 'messages', 'text' => 'Sweet, look at you updating that user.']);
  }


  /**
   * Remove a role from user in database
   *
   * @param  String  $id
   * @return Response
   */
  public function destroy($id)
  {
    User::where(['_id' => $id])->firstOrFail()->removeRole(1);
    return Redirect::back()->with('flash_message', ['class' => 'messages', 'text' => "The less admins the warier"]);
  }


  /**
   * Display user/users found by processing the Input
   *
   * @return Response
   */
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

  public function adminCreate($user_id)
  {
    // Create a new user in database with admin role
    User::firstOrCreate(['_id' => $user_id])->assignRole(1);
    return Redirect::back()->with('flash_message', ['class' => 'messages', 'text' => 'The more admins the merrier.']);
  }


  public function adminIndex()
  {
    $db_admins = User::has('roles', 1)->get()->all();
    foreach($db_admins as $admin){
      $users[] = $this->northstar->getUser('_id', $admin['_id']);
    }
    return View::make('users.admin-index')->with(compact('users'));
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


  /**
   * Making request to NorthstarAPI to delete users marked
   * for deletion from duplication form
   *
   */
  public function deleteUnmergedUsers()
  {
    $inputs = Input::all();
    $delete_ids = $inputs['delete'];
    foreach($delete_ids as $id){
      $this->northstar->deleteUser($id);
    }
  }
}
