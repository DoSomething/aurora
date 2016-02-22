@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'Users', 'subtitle' => 'View & edit member profiles.'])

<div class="container -padded">
  <div class="wrapper">
      <div class="container__block">
          <h1>All Users</h1>
          <p>We currently have <strong>{{ number_format($users->total()) }} members</strong> in Northstar.</p>
          @include('search.search')
      </div>

      <div class="container__block">
          @if ($users)
              @include('users.partials.index-table', ['users' => $users])
              {!! $users->links(\Aurora\Http\Presenters\ForgePaginationPresenter::class) !!}
          @endif
      </div>

  </div>
</div>
<script>
  advancedSearchToggle()
</script>
@stop
