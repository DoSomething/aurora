@extends('layout.master')

@section('main_content')
<div class="container -padded">
	<div class="container__block">
		<a href="{{ route('keys.create') }}">New App</a>
	</div>
		<h2> Listing of all Northstar API keys</h2>
		@if ($keys)
			<ul class="gallery -duo">
			  @foreach($keys as $key)
			    <li>
			      <article class="figure -left">
	          	<dt><strong> App ID: </strong> {{ $key['app_id'] }} </dt>
	          	<dt><strong> API Key: </strong>{{ $key['api_key'] }} </dt>
			      </article>
			    </li>
			  @endforeach
			</ul>
		@endif
	</div>
</div>
@stop