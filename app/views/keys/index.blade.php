@extends('layout.master')

@section('main_content')
<header class="header" role="banner">
  <div class="wrapper">
    <h1 class="header__title">
     	API Keys
    </h1>
    <p class="header__subtitle">
      Listing of all Northstar API Keys
    </p>
  </div>
</header>

<div class="container -padded">
  <div class="wrapper">
		<div class="container__block">
			<a href="{{ route('keys.create') }}">New App</a>
		</div>
		@if ($keys)
			<ul class="gallery -duo">
			  @forelse($keys as $key)
			    <li>
			      <article class="figure -left">
	          	<dt><strong> App ID: </strong> {{ $key['app_id'] }} </dt>
	          	<dt><strong> API Key: </strong>{{ $key['api_key'] }} </dt>
			      </article>
			    </li>
		    @empty
					<h3>No API Keys</h3>
			  @endforelse
			</ul>
		@endif
	</div>
</div>
@stop