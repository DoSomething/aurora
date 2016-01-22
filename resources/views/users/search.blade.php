@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'Users', 'subtitle' => 'View & edit member profiles.'])

<div class="container -padded">
  <div class="wrapper">
      <div class="container__block">
          <h1>Search Results</h1>
          <p>Your search for &lsquo;{{ $query }}&rsquo; returned <strong>{{ number_format($users->total()) }} results</strong>.</p>
          @include('search.search')
      </div>

      <div class="container__block">
          @if ($users)
              @include('users.partials.index-table', ['users' => $users])
              {!! $users->appendPaginationQuery(['query' => $query])->links() !!}
          @endif
      </div>

  </div>
</div>
<script>
  advancedSearchToggle()
</script>
@stop
