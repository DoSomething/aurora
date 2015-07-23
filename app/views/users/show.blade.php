@extends('layout.master')

@section('main_content')

@include('layout.header', ["header" => ((isset($northstarProfile['first_name']) ? $northstarProfile['first_name'] : "") . " " . (isset($northstarProfile['last_name']) ? $northstarProfile['last_name'] : "")), "subtitle" => ""])

<h1 class="heading -banner"><span>Account Info</span></h1>
<div class="container -padded">
  <div class="wrapper">
    <div class="container__block">
      <a href="{{ url('users/' . $northstarProfile['_id'] . '/edit') }}">Edit User</a>
      @if ($auroraUser)
        Admin: {{ $auroraUser->hasRole('admin') ? '✓' : 'x' }}
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

<h1 class="heading -banner"><span>Reportbacks</span></h1>
<div class="container -padded">
  <div class="wrapper">
    <div class="container__block">
      @include('users.partials.reportbacks')
    </div>
  </div>
</div>

<h1 class="heading -banner"><span>Mobile Commons Activity</span></h1>
<div class="container -padded">
  <div class="wrapper">
    <div class="container__block">
      @include('users.partials.mobile-commons')
    </div>
  </div>
</div>

@stop
