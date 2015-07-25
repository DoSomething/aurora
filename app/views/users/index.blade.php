@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'User Index', 'subtitle' => 'Listing of all users'])

<div class="container -padded">
  <div class="wrapper">

    @include('users.partials.search')

    @if ($users)
      <p> Total members : {{{ number_format($data['total']) }}}</p>

      @include('users.partials.index-table')

      @include('users.partials.waypoints')

    @endif
  </div>
</div>
@stop
