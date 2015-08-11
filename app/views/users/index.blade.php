@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'User Index', 'subtitle' => 'Listing of all users'])



<div class="container -padded">
  <div class="wrapper">

    @include('users.partials.search')
    <a href="#" id="advanced-search-link">Advanced Search</a>

    <div id="advanced-search-container" class="container__block -narrow">
      {{ Form::open(array('url' => '/advanced-search')) }}
        <label class="option -radio">
          {{ Form::radio('source', 'agg', false) }}
          <span class="option__indicator"></span>
          {{ Form::label('Agg') }}
        </label>
        <label class="option -radio">
          {{ Form::radio('source', 'cgg', false) }}
          <span class="option__indicator"></span>
          {{ Form::label('Cgg') }}
        </label>
        <label class="option -radio">
          {{ Form::radio('source', 'drupal', false) }}
          <span class="option__indicator"></span>
          {{ Form::label('Drupal') }}
        </label>
        <label class="option -radio">
          {{ Form::radio('source', 'web', false) }}
          <span class="option__indicator"></span>
          {{ Form::label('Web') }}
        </label>
        <label class="option -radio">
          {{ Form::radio('source', 'mobile', false) }}
          <span class="option__indicator"></span>
          {{ Form::label('Mobile') }}
        </label>
        <div class="form-item -inline">
          {{ Form::label('country', 'Country', ['class' => 'field-label']) }}
          {{ Form::text('country', NULL, ['class' => 'text-field']) }}
        </div>
        {{ Form::submit('Search', ['class' => 'button'])}}
      {{ Form::close() }}
    </div>
    @if ($users)
      <h3 class="heading -gamma">Total members : {{{ number_format($data['total']) }}}</h3>

      @include('users.partials.index-table', ['users' => $users])

      @include('users.partials.waypoints')

    @endif
  </div>
</div>
<script>
  advancedSearchToggle()
</script>
@stop
