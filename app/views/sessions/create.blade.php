@extends('layout.master')

@section('main_content')

<div class ="container col-md-6">

  {{ Form::open(['route' => 'sessions.store', 'class' => 'form-signin']) }}
    <h2 class="form-signin-heading">Please sign in</h2>


    {{ Form::text('email', NULL, array('class' => 'form-control', 'placeholder' => 'Email Address')) }}

    {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}

    {{ Form::submit('Sign in', array('class' => 'btn btn-lg btn-primary btn-block')) }}

  {{ Form::close() }}
</div>

@stop
