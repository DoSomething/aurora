@extends('layout.master')

@section('main_content')
  <div class="container -padded">
    <div class="wrapper">
      <h2 class="heading account-info">Account Info</h2>
      <a href="{{ url('users/' . $user['_id'] . '/edit') }}"> Edit User <span class="glyphicon glyphicon-pencil"></span></a>
      @if ($aurora_user)
        Admin: {{ $aurora_user->hasRole('admin') ? '✓' : 'x' }}
        @if (!$aurora_user->hasRole('admin'))
          {{ Form::open(['route' => array('admin.create', $aurora_user->id)]) }}
          {{ Form::submit('make admin') }}
          {{ Form::close() }}
        @endif
      @endif

      <div class="container -padded">
          @include('users.partials.details')
      </div>
    </div>
  </div>
@stop
