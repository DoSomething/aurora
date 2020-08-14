<?php

namespace Aurora\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use DoSomething\Gateway\Northstar;
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
        $page = $request->query('page', []);

        $admins = $this->northstar->getAllUsers([
            'filter' => ['role' => 'admin'],
            'page' => Arr::get($page, 'admin', 1),
        ]);
        $admins->setPaginator(LengthAwarePaginator::class, [
            'path' => 'superusers',
            'pageName' => 'page[admin]',
        ]);

        $staff = $this->northstar->getAllUsers([
            'filter' => ['role' => 'staff'],
            'page' => Arr::get($page, 'staff', 1),
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
