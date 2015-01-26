@extends('layout.master')

@section('main_content')

<div class ="container col-md-6">

  {{ Form::open(['route' => 'sessions.store', 'class' => 'form-signin']) }}
    <h2 class="form-signin-heading">Please sign in</h2>
    <div class="form-group">
      {{ Form::label('email', 'Email', array('class' => 'sr-only')) }}
      {{ Form::text('email', NULL, array('class' => 'form-control', 'placeholder' => 'Email Address')) }}
    </div>

    <div class="form-group">
      {{ Form::label('password', 'Password', array('class' => 'sr-only')) }}
      {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}
    </div>

    {{ Form::submit('Sign in', array('class' => 'btn btn-lg btn-primary btn-block')) }}

  {{ Form::close() }}
</div>

@stop
