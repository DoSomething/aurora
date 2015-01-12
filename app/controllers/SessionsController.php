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
    // Compare this to user api
    $northstar = new Aurora\Services\Northstar\NorthstarAPI;
    $res = $northstar->login($input);

    var_dump($res);
    // Login
  }

}
