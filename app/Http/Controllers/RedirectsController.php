<?php

namespace Aurora\Http\Controllers;

use Aurora\Services\Fastly;
use Illuminate\Http\Request;
use Aurora\Resources\Redirect;

class RedirectsController extends Controller
{
    /**
     * The Fastly API client.
     * @var Fastly
     */
    protected $fastly;

    /**
     * Create a RedirectsController.
     *
     * @param Fastly $fastly
     */
    public function __construct(Fastly $fastly)
    {
        $this->fastly = $fastly;

        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     * GET /redirects
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $redirects = $this->fastly->getAllRedirects();

        return view('redirects.index', ['redirects' => $redirects]);
    }

    /**
     * Show redirect details.
     * GET /redirects/:redirect_id
     *
     * @param Redirect $redirect
     * @return \Illuminate\Http\Response
     */
    public function show(Redirect $redirect)
    {
        return view('redirects.show', ['redirect' => $redirect]);
    }

    /**
     * Create a new redirect.
     * GET /redirects/create
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('redirects.create');
    }

    /**
     * Store a new redirect.
     * POST /redirects
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'path' => 'required|string|regex:/^[^?]+$/',
            'target' => 'required|url',
            'status' => 'required|in:301,302',
        ], [
            'path.regex' => 'Paths cannot contain query strings.'
        ]);

        $redirect = $this->fastly->createRedirect($request->path, $request->target, $request->status);

        return redirect()->route('redirects.show', $redirect->id);
    }

    /**
     * Edit redirect details.
     * GET /redirects/:redirect_id/edit
     *
     * @param Redirect $redirect
     * @return \Illuminate\Http\Response
     */
    public function edit(Redirect $redirect)
    {
        return view('redirects.edit', ['redirect' => $redirect]);
    }

    /**
     * Update an existing redirect's details.
     * PUT /redirects/:redirect_id
     *
     * @param Redirect $redirect
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Redirect $redirect, Request $request)
    {
        $this->validate($request, [
            'target' => 'required|url',
            'status' => 'required|in:301,302',
        ]);

        $this->fastly->updateRedirect($redirect->path, $request->target, $request->status);

        return redirect()->route('redirects.show', $redirect->id);
    }

    /**
     * Destroy an existing redirect.
     * DELETE /redirects/:redirect_id
     *
     * @param Redirect $redirect
     * @return \Illuminate\Http\Response
     */
    public function destroy(Redirect $redirect)
    {
        $successful = $this->fastly->deleteRedirect($redirect->id);

        if (! $successful) {
            return redirect()->route('redirects.index')->with('flash_message', ['class' => 'messages -error', 'text' => 'Could not delete redirect.']);
        }

        return redirect()->route('redirects.index')->with('flash_message', ['class' => 'messages', 'text' => 'BAM! Deleted.']);
    }
}
