  <div class="form-item -inline -padded" id="normal-search-container">
    {{ Form::open(['action' => 'UsersController@search']) }}
      {{ Form::text('search_by', NULL, ['class' => 'text-field -search', 'placeholder' => 'Search a user...']) }}
      {{ Form::submit('Email', ['name' => 'type', 'class' => 'button -secondary']) }}
      {{ Form::submit('Mobile', ['name' => 'type', 'class' => 'button -secondary']) }}
      {{ Form::submit('Drupal uid', ['name' => 'type', 'class' => 'button -secondary']) }}
    {{ Form::close () }}
  </div>
