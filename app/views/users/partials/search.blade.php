  <div class="form-item -inline -padded" id="normal-search-container">
    {{ Form::open(['action' => 'UsersController@search']) }}
      {{ Form::text('search_by', NULL, ['class' => 'text-field -search', 'placeholder' => 'Search a user']) }}
      {{ Form::submit('Search', ['name' => 'type', 'class' => 'button -secondary']) }}
    {{ Form::close () }}
  </div>
