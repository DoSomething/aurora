<?php

class SessionsController extends \BaseController {


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    if (Auth::check())
    {
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

      // @TODO log user in

    } catch (Exception $e) {
       return Redirect::route('login')->with('flash_message', ['class' => 'alert alert-danger', 'text' => 'Login failed'])->withInput();
    }
  }

}
