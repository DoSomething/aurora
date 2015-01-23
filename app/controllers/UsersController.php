<?php

class UsersController extends \BaseController {

  public function __construct() {
    $this->beforeFilter('auth');
    $this->beforeFilter('role:admin');
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
      $northstar = new Aurora\Services\Northstar\NorthstarAPI;
      $users = $northstar->getAllUsers();
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
    $user = Session::get('user');
    if (!$user) {
      $northstar = new Aurora\Services\Northstar\NorthstarAPI;
      $user = $northstar->getUser('_id', $id);
    }
    return View::make('users.show')->with(compact('user'));
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $northstar = new Aurora\Services\Northstar\NorthstarAPI;
    $user = $northstar->getUser('_id', $id);
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
    //
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
      $northstar = new Aurora\Services\Northstar\NorthstarAPI;
      $user = $northstar->getUser($type, $search);
      return Redirect::route('users.show', array($user['_id']))->with(compact('user'));

    } catch (Exception $e) {
      return Redirect::back()->withInput()->with('flash_message', ['class' => 'alert alert-warning', 'text' => 'Hmm, couldn\'t find anyone, are you sure thats right?']);
    }
  }


}
