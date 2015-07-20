@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'User Index', 'subtitle' => 'Listing of all users'])

<div class="container -padded">
  <div class="wrapper">

    @include('users.partials.search')
    
    @if ($users)
      <p class="pagination-buttons"> Total members : {{{ number_format($data['total']) }}}</p>

      @include('users.partials.waypoints')

      @include('users.partials.index-table')

    @endif
  </div>
</div>
@stop
