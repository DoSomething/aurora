<?php

namespace Aurora\Http\Controllers;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display the homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('home');
    }
}
