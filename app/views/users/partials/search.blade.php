  <div class="form-item -inline -padded">
    {{ Form::open(['action' => 'UsersController@search']) }}
      {{ Form::text('search_by', NULL, ['class' => 'text-field', 'placeholder' => 'Search by...']) }}

        {{ Form::submit('Email', ['name' => 'type', 'value' => 'email', 'class' => 'button']) }}
        {{ Form::submit('Mobile', ['name' => 'type', 'class' => 'button']) }}
        {{ Form::submit('Drupal uid', ['name' => 'type', 'class' => 'button']) }}
  </div>
{{ Form::close () }}
