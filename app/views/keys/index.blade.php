@extends('layout.master')

@section('main_content')
<div class="container__block">
	<a href="{{ URL::Route('keys.create') }}"><span class='glyphicon glyphicon-plus'></span>New App</a>

	<h2> Listing of all Northstar api keys. </h2>

	@if ($keys)
		@include('keys.partials.api-keys')
	@endif
	
</div>
@stop
