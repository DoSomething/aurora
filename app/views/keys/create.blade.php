@extends('layout.master')

@section('main_content')

<div class ="container -padded">
	<div class="">
	  {{ Form::open(['route' => 'keys.store', 'method' => 'post']) }}

			@include('keys.partials.form')


	  {{ Form::close() }}
  </div>
</div>

@stop
