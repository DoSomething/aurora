@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => "Aurora", 'subtitle' => "User admin tool to view Northstar Users"])
<div class="container -padded">
	<div class="wrapper">
		<div class="container__block">
	    <h1 class="heading -hero">You have arrived.</h1>
				@if (Session::has('trigger_modal'))
				  {{ autoOpenModal() }}
				@endif
		</div>
	</div>
</div>

@stop
