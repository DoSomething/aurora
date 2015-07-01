@extends('layout.master')

@section('main_content')


<div class ="container">
  {{ Form::model($user, [ 'method' => 'PATCH', 'route' => ['users.update', $user['_id']]]) }}
    <div class="form-item -padded">

      {{ Form::label('_id', 'Mongo Id', ['class' => 'field-label']) }}
      <div class="col-sm-10">
        {{ Form::text('_id', NULL, ['class' => 'text-field', 'disabled' => 'true']) }}
      </div>
    </div>

    <div class="form-item -padded">
      {{ Form::label('drupal_uid', 'Drupal UID', ['class' => 'field-label']) }}
      <div class="col-sm-10">
        {{ Form::text('drupal_uid', NULL, ['class' => 'text-field', 'disabled' => 'true']) }}
      </div>
    </div>

    <div class="form-item -padded">
      {{ Form::label('first_name', 'First Name', ['class' => 'field-label']) }}
      <div class="col-sm-10">
        {{ Form::text('first_name', NULL, ['class' => 'text-field']) }}
      </div>
    </div>

    <div class="form-item -padded">
      {{ Form::label('last_name', 'Last Name', ['class' => 'field-label']) }}
      <div class="col-sm-10">
        {{ Form::text('last_name', NULL, ['class' => 'text-field']) }}
      </div>
    </div>

    <div class="form-item -padded">
      {{ Form::label('email', 'Email', ['class' => 'field-label']) }}
      <div class="col-sm-10">
        {{ Form::text('email', NULL, ['class' => 'text-field']) }}
      </div>
    </div>

    <div class="form-item -padded">
      {{ Form::label('mobile', 'Mobile', ['class' => 'field-label']) }}
      <div class="col-sm-10">
        {{ Form::text('mobile', NULL, ['class' => 'text-field']) }}
      </div>
    </div>

    <div class="form-item -padded">
      {{ Form::label('birthdate', 'Birthdate', ['class' => 'field-label']) }}
      <div class="col-sm-10">
        {{ Form::text('birthdate', NULL, ['class' => 'text-field']) }}
      </div>
    </div>

    <div class="form-item -padded">
      {{ Form::label('addr_street1', 'Address St 1', ['class' => 'field-label']) }}
      <div class="col-sm-10">
        {{ Form::text('addr_street1', NULL, ['class' => 'text-field']) }}
      </div>
      {{ Form::label('addr_street2', 'Address St 2', ['class' => 'field-label']) }}
      <div class="col-sm-10">
        {{ Form::text('addr_street2', NULL, ['class' => 'text-field']) }}
      </div>
      {{ Form::label('addr_city', 'City', ['class' => 'field-label']) }}
      <div class="col-sm-10">
        {{ Form::text('addr_city', NULL, ['class' => 'text-field']) }}
      </div>
     {{ Form::label('addr_state', 'State', ['class' => 'field-label']) }}
      <div class="col-sm-10">
        {{ Form::text('addr_state', NULL, ['class' => 'text-field']) }}
      </div>
     {{ Form::label('addr_zip', 'Zipcode', ['class' => 'field-label']) }}
      <div class="col-sm-10">
        {{ Form::text('addr_zip', NULL, ['class' => 'text-field']) }}
      </div>
      {{ Form::label('country', 'Country', ['class' => 'field-label']) }}
      <div class="col-sm-10">
        {{ Form::text('country', NULL, ['class' => 'text-field']) }}
      </div>

    </div>
    {{ Form::submit('Save', ['class' => 'button', 'name' => 'complete']) }}

  {{ Form::close() }}
</div>
@stop
