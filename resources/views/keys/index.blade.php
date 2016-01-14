@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'API Keys', 'subtitle' => 'Northstar application access & permissions'])

<div class="container -padded">
  <div class="wrapper">
      <div class="container__block">
          <ul class="gallery -duo">
              <div class="gallery__heading"><h1>All Keys</h1></div>
              @forelse($keys as $key)
                  <li>
                      <article class="figure -left">
                          <div class="figure__media">
                              <a href="{{ route('keys.show', [$key['api_key']]) }}">
                                  <img alt="key" src="/assets/key{{ in_array('admin', $key['scope']) ? '-admin' : '' }}.svg" />
                              </a>
                          </div>
                          <div class="figure__body">
                              <h4><a href="{{ route('keys.show', [$key['api_key']]) }}">{{ $key['app_id'] }}</a></h4>
                              <span class="footnote">{{ implode(', ', $key['scope']) }}</span>
                          </div>
                      </article>
                  </li>
              @empty
                  <h3>No API Keys</h3>
              @endforelse
          </ul>
      </div>
      <div class="container__block">
          <a class="button -secondary" href="{{ route('keys.create') }}">New App</a>
      </div>
	</div>
</div>
@stop
