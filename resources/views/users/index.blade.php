@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'Users', 'subtitle' => 'View & edit member profiles.'])

<div class="container -padded">
  <div class="wrapper">
      <div class="container__block">
          <h1>All Users</h1>
          {{-- @TODO (2020-02-27): Re-enable this after #170078318 is solved. --}}
          {{-- <p>We currently have <strong><span id="lazy-user-count" class="lazy-loading">#,###,###</span> users</strong> in Northstar.</p> --}}
          @include('search.search')
      </div>

      <div class="container__block">
          @if ($users)
              @include('users.partials.index-table', ['users' => $users])
              {{ $users->links() }}
          @endif
      </div>

  </div>
</div>
@stop
