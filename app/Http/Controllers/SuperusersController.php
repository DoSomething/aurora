<?php

namespace Aurora\Http\Controllers;

use DoSomething\Northstar\Northstar;
use Illuminate\Http\Request;
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
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $admins = $this->northstar->getAllUsers([
            'filter' => ['role' => 'admin'],
            'page' => $request->get('page[admin]', 1, true),
        ]);
        $admins->setPaginator(LengthAwarePaginator::class, [
            'path' => 'superusers',
            'pageName' => 'page[admin]',
        ]);

        $staff = $this->northstar->getAllUsers([
            'filter' => ['role' => 'staff'],
            'page' => $request->get('page[staff]', 1, true),
        ]);
        $staff->setPaginator(LengthAwarePaginator::class, [
            'path' => 'superusers',
            'pageName' => 'page[staff]',
        ]);

        $groups = [
            'admin' => $admins,
            'staff' => $staff,
        ];

        return view('superusers.index')->with(['groups' => $groups]);
    }
}
