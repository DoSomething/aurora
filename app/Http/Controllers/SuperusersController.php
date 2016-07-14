<?php

namespace Aurora\Http\Controllers;

use DoSomething\Northstar\Northstar;
use Illuminate\Pagination\LengthAwarePaginator;

class SuperusersController extends Controller
{
    /**
     * Northstar API client.
     * @var Northstar
     */
    protected $northstar;

    public function __construct(Northstar $northstar)
    {
        $this->northstar = $northstar;

        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = $this->northstar->getAllUsers(['filter' => ['role' => 'admin']]);
        $admins->setPaginator(LengthAwarePaginator::class, [
            'path' => 'aurora-users',
        ]);

        $staff = $this->northstar->getAllUsers(['filter' => ['role' => 'staff']]);
        $staff->setPaginator(LengthAwarePaginator::class, [
            'path' => 'aurora-users',
        ]);
        
        $users = [
            'admin' => $admins,
            'staff' => $staff,
        ];

        return view('superusers.index')->with(compact('users'));
    }
}
