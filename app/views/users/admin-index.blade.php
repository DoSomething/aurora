@extends('layout.master')

@section('main_content')

@include('layout.header', ["header" => "Admin Index", "subtitle" => "Listing of all admins"])

@if (!empty($admins))
  <h1 class="heading -banner"><span>Admins</span></h1>
  <div class="container -padded">
    <div class="wrapper">
      <div class="container__block">
        @include('users.partials.index-table', ['users' => $admins])
      </div>
    </div>
  </div>
@endif
@if (!empty($staffs))
  <h1 class="heading -banner"><span>Staff</span></h1>
  <div class="container -padded">
    <div class="wrapper">
      <div class="container__block">
        @include('users.partials.index-table', ['users' => $staffs])
      </div>
    </div>
  </div>
@endif
@if (!empty($interns))
  <h1 class="heading -banner"><span>Interns</span></h1>
  <div class="container -padded">
    <div class="wrapper">
      <div class="container__block">
        @include('users.partials.index-table', ['users' => $interns])
      </div>
    </div>
  </div>
@endif
@if (!empty($unassigned))
  <h1 class="heading -banner"><span>Unassigned</span></h1>
  <div class="container -padded">
    <div class="wrapper">
      <div class="container__block">
        @include('users.partials.index-table', ['users' => $unassigned])
      </div>
    </div>
  </div>
@endif


@stop
