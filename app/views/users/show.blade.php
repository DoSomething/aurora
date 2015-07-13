@extends('layout.master')

@section('main_content')

@include('layout.header', ["header" => ((isset($user['first_name']) ? $user['first_name'] : "") . " " . (isset($user['last_name']) ? $user['last_name'] : "")), "subtitle" => "View user info"])

<h1 class="heading -banner"><span>Account Info</span></h1>
<div class="container -padded">
  <div class="wrapper">
    <div class="container__block">
      <a href="{{ url('users/' . $user['_id'] . '/edit') }}">Edit User</a>
      @if ($aurora_user)
        Admin: {{ $aurora_user->hasRole('admin') ? '✓' : 'x' }}
      @endif
      @include('users.partials.details')
    </div>
  </div>
</div>
<h1 class="heading -banner"><span>Campaigns</span></h1>
<div class="container -padded">
  <div class="wrapper">
    <div class="container__block">
      @include('users.partials.campaigns')
    </div>
  </div>
</div>

<div class="container -padded">
  <div class="wrapper">
    <div class="container__block -half">
      @if (!$aurora_user)
        @include('users.partials.make-admin')
      @endif
    </div>
  </div>    
</div>    

@stop
