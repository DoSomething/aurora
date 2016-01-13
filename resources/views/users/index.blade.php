@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'User Index', 'subtitle' => 'Listing of all users'])



<div class="container -padded">
  <div class="wrapper">

    @include('search.search')
    @if ($users)
      <h3 class="heading -gamma">Total members : {{ number_format($data['meta']['pagination']['total']) }}</h3>

      @include('users.partials.index-table', ['users' => $users])

      @include('users.partials.waypoints')

    @endif
  </div>
</div>
<script>
  advancedSearchToggle()
</script>
@stop
