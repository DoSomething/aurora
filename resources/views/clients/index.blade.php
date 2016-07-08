@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'OAuth Clients', 'subtitle' => 'Northstar application access & permissions'])

<div class="container -padded">
  <div class="wrapper">
      <div class="container__block -narrow">
          <div class="gallery__heading"><h1>All Clients</h1></div>
          <p>These are the OAuth clients registered in Northstar and the permissions they are allowed to grant. See <a href="https://github.com/DoSomething/northstar/blob/dev/documentation/authentication.md">Northstar's documentation</a> for more details.</p>
      </div>
      <ul class="gallery -duo">
          @forelse($clients as $client)
              <li>
                  <article class="figure -left">
                      <div class="figure__media">
                          <a href="{{ route('clients.show', [$client->client_id]) }}">
                              <img alt="key" src="/assets/key{{ in_array('admin', $client->scope) ? '-admin' : '' }}.svg" />
                          </a>
                      </div>
                      <div class="figure__body">
                          <h4><a href="{{ route('clients.show', [$client->client_id]) }}">{{ $client->client_id }}</a></h4>
                          <span class="footnote">{{ implode(', ', $client->scope) }}</span>
                      </div>
                  </article>
              </li>
          @empty
              <h3>No API Keys</h3>
          @endforelse

{{--              {!! $clients->links(\Aurora\Http\Presenters\ForgePaginationPresenter::class) !!}--}}
      </ul>
      <div class="container__block">
          <a class="button -secondary" href="{{ route('clients.create') }}">New Client</a>
      </div>
	</div>
</div>
@stop
