@extends('layout.master')

@section('main_content')
<div class="container__block">
	<a href="{{ URL::Route('keys.create') }}"><span class='glyphicon glyphicon-plus'></span>New App</a>
</div>
<div class="container__block">
	<h2> Listing of all Northstar API keys. </h2>
	@if ($keys)
		<ul class="gallery -duo">
		  @foreach($keys as $key)
		    <li>
		      <article class="figure -left">
		          <div class = "well" >
		           <dt><strong> App ID: </strong> {{ $key['app_id'] }} </dt>
		           <dt><strong> API Key: </strong>{{ $key['api_key'] }} </dt>
		          </div>
		      </article>
		    </li>
		  @endforeach
		</ul>
	@endif
</div>
@stop