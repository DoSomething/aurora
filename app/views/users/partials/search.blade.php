<div class="col-lg-6">
  <div class="input-group">
    {{ Form::open(['action' => 'UsersController@search']) }}
      {{ Form::text('search_by', NULL, ['class' => 'form-control', 'placeholder' => 'Search by...']) }}

      <div class="btn-group" role="group">
        {{ Form::submit('Email', ['name' => 'type', 'value' => 'email', 'class' => 'btn btn-default']) }}
        {{ Form::submit('Mobile', ['name' => 'type', 'class' => 'btn btn-default']) }}
        {{ Form::submit('Drupal uid', ['name' => 'type', 'class' => 'btn btn-default']) }}
    </div>
  </div>
{{ Form::close () }}
