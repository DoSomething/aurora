<?php

class KeyController extends \BaseController {

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
      $keys = $northstar->getAllApiKeys();
      return View::make('keys.index')->with(compact('keys'));

    } catch (Exception $e) {
      return View::make('keys.index')->with('flash_message', ['class' => 'alert alert-warning', 'text' => 'Looks like there is something wrong with the connection!']);
    }
  }

}
