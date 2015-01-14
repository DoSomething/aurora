<?php

class UsersController extends \BaseController {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    // @TODO: return all users.
    return View::make('users.index');
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

  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    //
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
      return View::make('users.show')->with(compact('user'));

    } catch (Exception $e) {
      return Redirect::back()->withInput()->with('flash_message', ['class' => 'alert alert-warning', 'text' => 'Hmm, couldn\'t find anyone, are you sure thats right?']);
    }
  }


}
