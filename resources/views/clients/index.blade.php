@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'OAuth Clients', 'subtitle' => 'Northstar application access & permissions'])

<div class="container -padded">
  <div class="wrapper">
      <div class="container__block -narrow">
          <div class="gallery__heading"><h1>All Clients</h1></div>
          <p>These are the OAuth clients registered in Northstar and the permissions they are allowed to grant.</p>
      </div>
      <ul class="gallery -duo">
          @forelse($clients as $client)
              <li>
                  <article class="figure -left">
                      <div class="figure__media">
                          <a href="{{ route('clients.show', [$client->client_id]) }}">
                              <img alt="key" src="/images/{{ $client->allowed_grant === 'authorization_code' ? 'user' : 'machine'}}.svg" />
                          </a>
                      </div>
                      <div class="figure__body">
                          <h4><a href="{{ route('clients.show', [$client->client_id]) }}">{{ $client->title }}</a></h4>
                          <span class="footnote">{{ implode(', ', $client->scope) }}</span>
                      </div>
                  </article>
              </li>
          @empty
              <h3>No OAuth clients.</h3>
          @endforelse

          {!! $clients->links(\Aurora\Http\Presenters\ForgePaginationPresenter::class) !!}
      </ul>
      <div class="container__block">
          <a class="button -secondary" href="{{ route('clients.create') }}">New Client</a>
      </div>
      <div class="container__block -narrow">
          <h1>Public Key</h1>
          <p>The public key can be used by other DoSomething.org services (i.e. resource servers) to verify JWT access tokens granted by Northstar (<code>{{ $key['issuer'] }}</code>).</p>
          <pre>{{ $key['public_key'] }}</pre>
          <p>See <a href="https://github.com/DoSomething/northstar/blob/dev/documentation/authentication.md">Northstar's documentation</a> for more details.</p>
      </div>


	</div>
</div>
@stop
