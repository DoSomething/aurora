@extends('layout.master')

@section('main_content')

@include('layout.header', ["header" => "Staff Index", "subtitle" => "Listing of all staff logged into Aurora"])

  @forelse($group as $role => $users)
    @if (!empty($group[$role]))
      <h1 class="heading -banner"><span>{{ $role }}</span></h1>
      <div class="container -padded">
        <div class="wrapper">
          <div class="container__block">
            @include('users.partials.index-table', ['users' => $users])
          </div>
        </div>
      </div>
    @endif
  @empty
  <!-- Display Nothing -->
  @endforelse
@stop
