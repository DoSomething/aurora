@extends('layout.master')

@section('main_content')

@include('layout.header', ["header" => "Admin Index", "subtitle" => "Listing of all admins"])
<div class="container -padded">
  <div class="wrapper">
    <div class="container__block">
      @include('users.partials.index-table')
    </div>
  </div>
</div>
@stop
