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

<!-- for flash messages -->
@if (Session::has('flash_message'))
  <div class="{{ Session::get('flash_message')['class'] }}">
    <em>{{ Session::get('flash_message')['text'] }}</em>
  </div>
@endif

<!-- for log in failure  -->
@if (Session::has('trigger_modal'))
  <div class="{{ Session::get('trigger_modal')['class'] }}">
    <em>{{ Session::get('trigger_modal')['text'] }}</em>
  </div>
@endif


@stop
