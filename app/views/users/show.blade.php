@extends('layout.master')

@section('main_content')
<header class="header" role="banner">
  <div class="wrapper">
    <h1 class="header__title">
      {{ $user['first_name'] or '' }} {{ $user['last_name'] or '' }}
    </h1>
    <p class="header__subtitle">
      View user info
    </p>
  </div>
</header>

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
      @if ($aurora_user)
        Admin: {{ $aurora_user->hasRole('admin') ? '✓' : 'x' }}
      @endif
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
