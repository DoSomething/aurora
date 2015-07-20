@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'Sign In', 'subtitle' => ''])

<div class="container -padded">
	<div class="wrapper">
		<div class="container__block">
			@include('sessions.partials.login-form')
		</div>
	</div>
</div>

@stop
