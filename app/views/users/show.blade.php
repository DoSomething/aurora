@extends('layout.master')

@section('main_content')

@include('layout.header', ["header" => ((isset($northstar_profile['first_name']) ? $northstar_profile['first_name'] : "") . " " . (isset($northstar_profile['last_name']) ? $northstar_profile['last_name'] : "")), "subtitle" => ""])

<h1 class="heading -banner"><span>Account Info</span></h1>
<div class="container -padded">
  <div class="wrapper">
    <div class="container__block">
      <dl class="profile-settings">
      <dt><a href="{{ url('users/' . $northstar_profile['_id'] . '/edit') }}">Edit User</a></dt>
      @if (isset($role))
        <dt>Role: {{ $role }}</dt>
      @endif
      </dl>
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
