@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'User Index', 'subtitle' => 'Listing of all users'])



<div class="container -padded">
  <div class="wrapper">

    @include('users.partials.search')
    <a href="#" id="advanced-search-link">Advance Search Users </a>

    <div id="advanced-search-container" class="container__block -narrow">
      {{ Form::open(array('url' => '/advanced-search')) }}
      {{ Form::label('source', 'Source', ['class' => 'field-label']) }}
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
        {{ Form::radio('source', 'services', false) }}
        <span class="option__indicator"></span>
        {{ Form::label('Services') }}
      </label>
      <div class="form-item -inline">
        {{ Form::label('country', 'Country', ['class' => 'field-label']) }}
        {{ Form::text('country', NULL, ['class' => 'text-field']) }}
      </div>
      {{ Form::submit('Search', ['class' => 'button -secondary'])}}
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
