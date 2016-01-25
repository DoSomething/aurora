<?php

namespace Aurora\Http\Controllers;

use Aurora\NorthstarKey;
use Aurora\Services\Northstar;
use Illuminate\Http\Request;

class KeyController extends Controller
{
    /**
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
     * GET /keys
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keys = $this->northstar->getAllApiKeys();

        return view('keys.index')->with(compact('keys'));
    }

    /**
     * Show key details.
     * GET /keys/:api_key
     *
     * @param NorthstarKey $key
     * @return \Illuminate\Http\Response
     */
    public function show(NorthstarKey $key)
    {
        return view('keys.show')->with(compact('key'));
    }

    /**
     * Create a new key.
     * GET /keys/create
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $scopes = $this->northstar->scopes();

        return view('keys.create', compact('scopes'));
    }

    /**
     * Store a new key.
     * POST /keys
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->northstar->createNewApiKey($request->all());

        return redirect()->route('keys.index')->with('flash_message', ['class' => 'messages', 'text' => 'Cool, new app added!']);
    }

    /**
     * Edit key details.
     * GET /keys/:api_key/edit
     *
     * @param NorthstarKey $key
     * @return \Illuminate\Http\Response
     */
    public function edit(NorthstarKey $key)
    {
        $scopes = $this->northstar->scopes();

        return view('keys.edit')->with(compact('key', 'scopes'));
    }

    /**
     * Update an existing key's details.
     * PUT /keys/:api_key
     *
     * @param NorthstarKey $key
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(NorthstarKey $key, Request $request)
    {
        $this->northstar->updateApiKey($key->api_key, $request->all());

        return redirect()->route('keys.index')->with('flash_message', ['class' => 'messages', 'text' => 'Cool, saved those changes!']);
    }

    /**
     * Destroy an existing key.
     * DELETE /keys/:api_key
     *
     * @param NorthstarKey $key
     * @return \Illuminate\Http\Response
     */
    public function destroy(NorthstarKey $key)
    {
        $deleted = $this->northstar->deleteApiKey($key->api_key);

        if (! $deleted) {
            return redirect()->route('keys.index')->with('flash_message', ['class' => 'messages -error', 'text' => 'Could not delete key.']);
        }

        return redirect()->route('keys.index')->with('flash_message', ['class' => 'messages', 'text' => 'BAM! Deleted.']);
    }
}
