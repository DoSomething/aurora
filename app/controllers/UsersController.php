<?php
use Aurora\Services\Drupal\DrupalAPI;
use Aurora\Services\Northstar\NorthstarAPI;

class UsersController extends \BaseController {

  public function __construct(DrupalAPI $drupal, NorthstarAPI $northstar) {
    $this->beforeFilter('auth');
    $this->beforeFilter('role:admin');
    $this->drupal = $drupal;
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
      $users = $this->northstar->getAllUsers($input);
      return View::make('users.index')->with(compact('users'));
    } catch (Exception $e) {
      return View::make('users.index')->with('flash_message', ['class' => 'alert alert-warning', 'text' => 'Looks like there is something wrong with the connection!']);
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
    $campaigns = [];
    $user = Session::get('user');
    if (!$user) {
      $user = $this->northstar->getUser('_id', $id);
      $aurora_user = User::where('_id', $id)->first();
      if (!empty($user['campaigns'])){
        foreach($user['campaigns'] as $campaign){
           array_push($campaigns, $this->drupal->getCampaign($campaign['drupal_id']));
        }
      }
    }
    return View::make('users.show')->with(compact('user', 'aurora_user', 'campaigns'));
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
    return Redirect::back()->with('flash_message', ['class' => 'alert alert-success', 'text' => 'Sweet, look at you updating that user.']);
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    //
  }

  public function search()
  {
    $search = Input::get('search_by');
    $type = strtolower(str_replace(' ', '_', Input::get('type')));
    try {
      // Attempt to find the user.
      $user = $this->northstar->getUser($type, $search);

      return Redirect::route('users.show', $user['_id']);
      
    } catch (Exception $e) {
      return Redirect::back()->withInput()->with('flash_message', ['class' => 'alert alert-warning', 'text' => 'Hmm, couldn\'t find anyone, are you sure thats right?']);
    }
  }

  public function adminCreate($user_id)
  {
    // Create a new user in database with admin role
    User::create(['_id' => $user_id])->assignRole(1);
    return Redirect::back()->with('flash_message', ['class' => 'alert alert-success', 'text' => 'The more admins the merrier.']);
  }


}
