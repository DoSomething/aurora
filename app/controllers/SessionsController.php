<?php

class SessionsController extends \BaseController {


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    if (Auth::check()) {
      // Already loged in.
    }
    return View::make('sessions.create');
  }

    /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    $input = Input::only('email', 'password');
    // Try to log the user in with Norhtstar.
    try {
      $northstar = new Aurora\Services\Northstar\NorthstarAPI;
      $response = $northstar->login($input);
      $user = $this->mapToUser($response);
      Auth::login($user);

      return Redirect::route('users.index');

    } catch (Exception $e) {
      //  return Redirect::back()->with('flash_message', ['class' => 'alert alert-danger', 'text' => 'Login failed'])->withInput();
      $input['autoOpenModal'] = 'true';
      return Redirect::back()->with('flash_message', ['class' => 'alert alert-danger', 'text' => 'Login Failed'])->withInput($input);
    }
  }
  public function mapToUser($response)
  {
    $user = User::firstOrCreate(array('_id' => $response['_id']));
    return $user;
  }

   /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id = null)
  {
    Auth::logout();
    return Redirect::to('/')->with('flash_message', ['text' => 'You have been logged out!', 'class' => 'alert alert-success']);
  }


}
