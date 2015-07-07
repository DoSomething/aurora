@extends('layout.master')

@section('main_content')
  <div class="wrapper">
    <div class="container__block">
      <h2 class="heading account-info">Account Info</h2>
      <a href="{{ url('users/' . $user['_id'] . '/edit') }}">Edit User</a>
      @if ($aurora_user)
        Admin: {{ $aurora_user->hasRole('admin') ? '✓' : 'x' }}
      @endif
        <div class="container -padded">
          @include('users.partials.details')
        </div>
        @if (!$aurora_user)
          @include('users.partials.make-admin')
        @endif
    </div>
  </div>
@stop
