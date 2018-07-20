@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'OAuth Clients', 'subtitle' => 'Northstar application access & permissions'])

<div class="container -padded">
  <div class="wrapper">
      <div class="container__block -narrow">
          <div class="gallery__heading"><h1>All Clients</h1></div>
          <p>These are the OAuth clients registered in Northstar and the permissions they have been given. Tokens can be
             used to <a href="https://git.io/vdXBk">authorize requests</a> to any compatible DoSomething.org services.</p>
      </div>
      <ul class="gallery -duo">
          @forelse($clients as $client)
              <li>
                  <article class="figure -left client {{ starts_with($client->client_id, 'dev-') ? '-dev' : null }}">
                      <div class="figure__media">
                          <a href="{{ route('clients.show', [$client->client_id]) }}">
                              <img alt="key" src="/images/{{ $client->allowed_grant === 'authorization_code' ? 'user' : 'machine'}}.svg" />
                          </a>
                      </div>
                      <div class="figure__body">
                          <h4><a href="{{ route('clients.show', [$client->client_id]) }}">{{ $client->client_id }}</a></h4>
                          <span class="footnote">{{ implode(', ', $client->scope) }}</span>
                          @if(starts_with($client->client_id, 'dev-'))
                              <span class="footnote client__hint">Use for development!</span>
                          @endif
                      </div>
                  </article>
              </li>
          @empty
              <h3>No OAuth clients.</h3>
          @endforelse

      </ul>
      <div class="container__block">
          {{ $clients->links() }}
      </div>
      <div class="container__block">
          <a class="button -secondary" href="{{ route('clients.create') }}">New Client</a>
      </div>

	</div>
</div>
@stop
