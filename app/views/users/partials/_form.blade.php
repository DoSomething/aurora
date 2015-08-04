<div class="container__block -narrow">
  {{ Form::model($user, [ 'method' => 'PATCH', 'route' => ['users.update', $user['_id']]]) }}
<div class="form-item -padded">
  {{ Form::label('_id', 'Mongo Id', ['class' => 'field-label']) }}
  {{ Form::text('_id', NULL, ['class' => 'text-field', 'disabled' => 'true']) }}
</div>
<div class="form-item -padded">
  {{ Form::label('drupal_id', 'Drupal ID', ['class' => 'field-label']) }}
  {{ Form::text('drupal_id', NULL, ['class' => 'text-field', 'disabled' => 'true']) }}
</div>
<div class="form-item -padded">
  {{ Form::label('first_name', 'First Name', ['class' => 'field-label']) }}
  {{ Form::text('first_name', NULL, ['class' => 'text-field']) }}
</div>
<div class="form-item -padded">
  {{ Form::label('last_name', 'Last Name', ['class' => 'field-label']) }}
  {{ Form::text('last_name', NULL, ['class' => 'text-field']) }}
</div>
<div class="form-item -padded">
  {{ Form::label('email', 'Email', ['class' => 'field-label']) }}
  {{ Form::text('email', NULL, ['class' => 'text-field']) }}
</div>
<div class="form-item -padded">
  {{ Form::label('mobile', 'Mobile', ['class' => 'field-label']) }}
  {{ Form::text('mobile', NULL, ['class' => 'text-field']) }}
</div>
<div class="form-item -padded">
  {{ Form::label('birthdate', 'Birthdate', ['class' => 'field-label']) }}
  {{ Form::text('birthdate', NULL, ['class' => 'text-field']) }}
</div>
<div class="form-item -padded">
  {{ Form::label('addr_street1', 'Address St 1', ['class' => 'field-label']) }}
  {{ Form::text('addr_street1', NULL, ['class' => 'text-field']) }}
</div>
<div class="form-item -padded">
  {{ Form::label('addr_street2', 'Address St 2', ['class' => 'field-label']) }}
  {{ Form::text('addr_street2', NULL, ['class' => 'text-field']) }}
</div>
<div class="form-item -padded">
  {{ Form::label('addr_city', 'City', ['class' => 'field-label']) }}
  {{ Form::text('addr_city', NULL, ['class' => 'text-field']) }}
</div>
<div class="form-item -padded">
 {{ Form::label('addr_state', 'State', ['class' => 'field-label']) }}
 {{ Form::text('addr_state', NULL, ['class' => 'text-field']) }}
</div>
<div class="form-item -padded">
 {{ Form::label('addr_zip', 'Zipcode', ['class' => 'field-label']) }}
 {{ Form::text('addr_zip', NULL, ['class' => 'text-field']) }}
</div>
<div class="form-item -padded">
  {{ Form::label('country', 'Country', ['class' => 'field-label']) }}
  {{ Form::text('country', NULL, ['class' => 'text-field']) }}
</div>
  {{ Form::submit('Save', ['class' => 'button', 'name' => 'complete']) }}
  {{ Form::close() }}
</div>