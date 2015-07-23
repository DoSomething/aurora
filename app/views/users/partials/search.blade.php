  <div class="form-item -inline -padded">
    {{ Form::open(['action' => 'UsersController@search']) }}
      {{ Form::text('search_by', NULL, ['class' => 'text-field -search', 'placeholder' => 'Search by...']) }}

        {{ Form::submit('Email', ['name' => 'type', 'class' => 'button -secondary']) }}
        {{ Form::submit('Mobile', ['name' => 'type', 'class' => 'button -secondary']) }}
        {{ Form::submit('Drupal uid', ['name' => 'type', 'class' => 'button -secondary']) }}
  </div>
{{ Form::close () }}
