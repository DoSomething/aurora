@extends('layout.master')

@section('main_content')

@include('layout.header', ["header" => "Admin Index", "subtitle" => "Listing of all admins"])
<div class="container -padded">
  <div class="wrapper">
    <div class="container__block">
      @if(empty($users))
        <h1>No admin found</h1>
      @else
        @include('users.partials.index-table')
      @endif
    </div>
  </div>
</div>
@stop
