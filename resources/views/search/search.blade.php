<div class="form-item -inline -padded" id="normal-search-container">
  {!! Form::open(['action' => 'UsersController@search', 'method' => 'get']) !!}
    {!! Form::text('search', NULL, ['class' => 'text-field -search', 'placeholder' => 'Find by email, mobile, Drupal ID…', 'style' => 'min-width: 400px']) !!}
    {!! Form::submit('Search', ['class' => 'button -secondary']) !!}
  {!! Form::close () !!}
</div>
