@extends('layout.master')

@section('main_content')


<div class ="container">
  {{ Form::model($user, [ 'method' => 'PATCH', 'route' => ['users.update', $user['_id']]]) }}
    <div class="form-group">

      {{ Form::label('_id', 'Mongo Id', ['class' => 'control-label col-sm-2']) }}
      <div class="col-sm-10">
        {{ Form::text('_id', NULL, ['class' => 'form-control', 'disabled' => 'true']) }}
      </div>
    </div>

    <div class="form-group">
      {{ Form::label('drupal_uid', 'Drupal UID', ['class' => 'control-label col-sm-2']) }}
      <div class="col-sm-10">
        {{ Form::text('drupal_uid', NULL, ['class' => 'form-control', 'disabled' => 'true']) }}
      </div>
    </div>

    <div class="form-group">
      {{ Form::label('first_name', 'First Name', ['class' => 'control-label col-sm-2']) }}
      <div class="col-sm-10">
        {{ Form::text('first_name', NULL, ['class' => 'form-control']) }}
      </div>
    </div>

    <div class="form-group">
      {{ Form::label('last_name', 'Last Name', ['class' => 'control-label col-sm-2']) }}
      <div class="col-sm-10">
        {{ Form::text('last_name', NULL, ['class' => 'form-control']) }}
      </div>
    </div>

    <div class="form-group">
      {{ Form::label('email', 'Email', ['class' => 'control-label col-sm-2']) }}
      <div class="col-sm-10">
        {{ Form::text('email', NULL, ['class' => 'form-control']) }}
      </div>
    </div>

    <div class="form-group">
      {{ Form::label('mobile', 'Mobile', ['class' => 'control-label col-sm-2']) }}
      <div class="col-sm-10">
        {{ Form::text('mobile', NULL, ['class' => 'form-control']) }}
      </div>
    </div>

    <div class="form-group">
      {{ Form::label('birthdate', 'Birthdate', ['class' => 'control-label col-sm-2']) }}
      <div class="col-sm-10">
        {{ Form::text('birthdate', NULL, ['class' => 'form-control']) }}
      </div>
    </div>

    <div class="form-group">
      {{ Form::label('addr_street1', 'Address St 1', ['class' => 'control-label col-sm-2']) }}
      <div class="col-sm-10">
        {{ Form::text('addr_street1', NULL, ['class' => 'form-control']) }}
      </div>
      {{ Form::label('addr_street2', 'Address St 2', ['class' => 'control-label col-sm-2']) }}
      <div class="col-sm-10">
        {{ Form::text('addr_street2', NULL, ['class' => 'form-control']) }}
      </div>
      {{ Form::label('addr_city', 'City', ['class' => 'control-label col-sm-2']) }}
      <div class="col-sm-10">
        {{ Form::text('addr_city', NULL, ['class' => 'form-control']) }}
      </div>
     {{ Form::label('addr_state', 'State', ['class' => 'control-label col-sm-2']) }}
      <div class="col-sm-10">
        {{ Form::text('addr_state', NULL, ['class' => 'form-control']) }}
      </div>
     {{ Form::label('addr_zip', 'Zipcode', ['class' => 'control-label col-sm-2']) }}
      <div class="col-sm-10">
        {{ Form::text('addr_zip', NULL, ['class' => 'form-control']) }}
      </div>
      {{ Form::label('country', 'Country', ['class' => 'control-label col-sm-2']) }}
      <div class="col-sm-10">
        {{ Form::text('country', NULL, ['class' => 'form-control']) }}
      </div>

    </div>

    {{ Form::submit('Save', ['class' => 'btn btn-large btn-default', 'name' => 'complete']) }}

  {{ Form::close() }}
</div>
@stop
