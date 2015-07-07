@extends('layout.master')

@section('main_content')

<div class ="container -padded">
  {{ Form::open(['route' => 'keys.store', 'method' => 'post']) }}

		@include('keys.partials.form')


  {{ Form::close() }}
</div>

@stop
