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
      return Redirect::route('status');
    }
    return View::make('sessions.create');
  }

}
