<?php

namespace Aurora\Http\Controllers;

use DoSomething\Gateway\Northstar;
use DoSomething\Gateway\Resources\NorthstarClient;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ClientController extends Controller
{
  /**
   * The Northstar API client.
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
   * GET /clients.
   *
   * @param Request $request
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $clients = $this->northstar->getAllClients($request->all());
    $clients->setPaginator(LengthAwarePaginator::class, [
      'path' => 'clients',
    ]);

    $key = $this->northstar->get('v2/key');

    return view('clients.index', ['clients' => $clients, 'key' => $key]);
  }

  /**
   * Show client details.
   * GET /clients/:client_id.
   *
   * @param NorthstarClient $client
   * @return \Illuminate\Http\Response
   */
  public function show(NorthstarClient $client)
  {
    return view('clients.show', ['client' => $client]);
  }

  /**
   * Create a new client.
   * GET /clients/create.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $scopes = $this->northstar->scopes();

    return view('clients.create', ['scopes' => $scopes]);
  }

  /**
   * Store a new client.
   * POST /clients.
   *
   * @param Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $parameters = $request->all();

    // Transform 'redirect_uri' from a CSV into an array of strings.
    $parameters['redirect_uri'] = csv_to_array($parameters['redirect_uri']);
    if ($parameters['allowed_grant'] === 'client_credentials') {
      unset($parameters['redirect_uri']);
    }

    $this->northstar->createNewClient($parameters);

    return redirect()
      ->route('clients.index')
      ->with('flash_message', [
        'class' => 'messages',
        'text' => 'Cool, new app added!',
      ]);
  }

  /**
   * Edit client details.
   * GET /clients/:client_id/edit.
   *
   * @param NorthstarClient $client
   * @return \Illuminate\Http\Response
   */
  public function edit(NorthstarClient $client)
  {
    $scopes = $this->northstar->scopes();

    return view('clients.edit', ['client' => $client, 'scopes' => $scopes]);
  }

  /**
   * Update an existing client's details.
   * PUT /clients/:client_id.
   *
   * @param NorthstarClient $client
   * @param Request $request
   * @return \Illuminate\Http\Response
   */
  public function update(NorthstarClient $client, Request $request)
  {
    $parameters = $request->all();

    // Transform 'redirect_uri' from a CSV into an array of strings.
    $parameters['redirect_uri'] = csv_to_array($parameters['redirect_uri']);
    if ($parameters['allowed_grant'] === 'client_credentials') {
      unset($parameters['redirect_uri']);
    }

    // Ensure that all scopes can be removed from a client.
    $parameters['scope'] = !empty($parameters['scope'])
      ? $parameters['scope']
      : [];

    $this->northstar->updateClient($client->client_id, $parameters);

    return redirect()
      ->route('clients.index')
      ->with('flash_message', [
        'class' => 'messages',
        'text' => 'Cool, saved those changes!',
      ]);
  }

  /**
   * Destroy an existing client.
   * DELETE /clients/:client_id.
   *
   * @param NorthstarClient $client
   * @return \Illuminate\Http\Response
   */
  public function destroy(NorthstarClient $client)
  {
    $deleted = $this->northstar->deleteClient($client->client_id);

    if (!$deleted) {
      return redirect()
        ->route('clients.index')
        ->with('flash_message', [
          'class' => 'messages -error',
          'text' => 'Could not delete client.',
        ]);
    }

    return redirect()
      ->route('clients.index')
      ->with('flash_message', [
        'class' => 'messages',
        'text' => 'BAM! Deleted.',
      ]);
  }
}
