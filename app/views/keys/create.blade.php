@extends('layout.master')

@section('main_content')


<div class ="container">
  {{ Form::open(['route' => 'keys.store', 'method' => 'post']) }}
    <div class="form-group">

      {{ Form::label('App Name', null, ['class' => 'control-label col-sm-2']) }}
      <div class="col-sm-10">
        {{ Form::text('app_name', NULL, ['class' => 'form-control']) }}
      </div>
    </div>

    {{ Form::submit('Submit', ['class' => 'btn btn-large btn-default']) }}

  {{ Form::close() }}

@stop
