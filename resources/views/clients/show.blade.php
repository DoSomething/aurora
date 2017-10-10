@extends('layout.master')

@section('main_content')

    @include('layout.header', ['header' => 'OAuth Clients', 'subtitle' => 'Northstar application access & permissions'])

    <div class="container -padded">
        <div class="wrapper">
            <div class="container__block -narrow">
                <h1>{{ $client->title }}</h1>
                @if(! empty($client->description))
                    <p>{{ $client->description }}</p>
                @endif
            </div>

            <div class="container__block -half">
                <h3>Credentials</h3>
                @if($client->allowed_grant == 'authorization_code')
                    <p>This is an application that users can login to via Northstar,
                    using the <a href="https://git.io/vduUZ">Authorization Code grant</a>.</p>
                @elseif($client->allowed_grant == 'client_credentials')
                    <p>This is a machine client that requests tokens via the
                    <a href="https://git.io/vduUC">Client Credentials grant</a>.</p>
                @else
                    <p>This client uses the <code>'{{ $client->allowed_grant }}'</code> grant.</p>
                @endif

                <br>
                <label class="field-label">Client ID:</label>
                <code>{{ $client->client_id }}</code><br><br>
                <label class="field-label">Client Secret:</label>
                <code>{{ $client->client_secret }}</code><br><br>

                @if($client->allowed_grant == 'authorization_code')
                    <label class="field-label">Redirect URIs:</label>
                    <code>{{ array_to_csv($client->redirect_uri) }}</code>
                @endif
            </div>

            <div class="container__block -half">
                <h3>Authorized Scopes</h3>
                <p>Authorized scopes determine what abilities this client is allowed to request when creating tokens:</p>
                <ul class="list -compacted">
                    @foreach($client->scope as $scope)
                        <li><code>{{ $scope }}</code></li>
                    @endforeach
                </ul>
            </div>

            <div class="container__block -narrow">
                <h3>Statistics</h3>
                <p>This client has <strong>{{ $client->refresh_tokens }}</strong> active refresh tokens.</p>
            </div>

            <div class="container__block -narrow">
                <a class="secondary" href="{{ route('clients.edit', [ $client->client_id]) }}">Edit this client</a>
                <p class="footnote">
                    Last updated: {{ $client->updated_at->format('F d, Y g:ia') }}<br />
                    Created: {{ $client->created_at->format('F d, Y g:ia') }}
                </p>
            </div>
        </div>
    </div>
@stop
