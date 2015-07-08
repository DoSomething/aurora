@extends('layout.master')

@section('main_content')
  <div class="wrapper">
    <div class="container__block">
      <h2 class="heading account-info">{{ $user['first_name'] or '' }} {{ $user['last_name'] or '' }}</h2>
      <a href="{{ url('users/' . $user['_id'] . '/edit') }}">Edit User</a>
      @if ($aurora_user)
        Admin: {{ $aurora_user->hasRole('admin') ? '✓' : 'x' }}
      @endif
      <div class=" -padded">
        @include('users.partials.details')
      </div>
      <div class="container__block -half">
        @if (!$aurora_user)
          @include('users.partials.make-admin')
        @endif
      </div>
    </div>
  </div>
@stop
