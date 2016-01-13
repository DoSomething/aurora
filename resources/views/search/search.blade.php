<div class="form-item -inline -padded" id="normal-search-container">
  {!! Form::open(['action' => 'UsersController@search', 'method' => 'get']) !!}
    {!! Form::text('search_by', NULL, ['class' => 'text-field -search', 'placeholder' => 'Email, mobile, drupal id']) !!}
    {!! Form::submit('Search', ['name' => 'type', 'class' => 'button -secondary']) !!}
  {!! Form::close () !!}
</div>

<a href="#" id="advanced-search-link">Advanced Search Options</a>

<div id="advanced-search-container">
  {!! Form::open(array('url' => '/advanced-search', 'method' => 'get')) !!}
<ul class="gallery -triad -aligned">
  <li>
    <div class="figure__body">
      <div class="form-item">
        {!! Form::label('first_name', 'First Name', ['class' => 'field-label']) !!}
        {!! Form::text('first_name', NULL, ['class' => 'text-field']) !!}
      </div>
      <div class="form-item">
        {!! Form::label('last_name', 'Last Name', ['class' => 'field-label']) !!}
        {!! Form::text('last_name', NULL, ['class' => 'text-field']) !!}
      </div>
      <div class="form-item">
        {!! Form::label('email', 'Email', ['class' => 'field-label']) !!}
        {!! Form::text('email', NULL, ['class' => 'text-field']) !!}
      </div>
      <div class="form-item">
        {!! Form::label('drupal', 'Drupal ID', ['class' => 'field-label']) !!}
        {!! Form::text('drupal', NULL, ['class' => 'text-field']) !!}
      </div>
    </div>
  </li>
  <li>
    <div class="figure__body">
      <div class="form-item">
        {!! Form::label('addr_state', 'State', ['class' => 'field-label']) !!}
        {!! Form::text('addr_state', NULL, ['class' => 'text-field']) !!}
      </div>
      <div class="form-item">
        {!! Form::label('addr_zip', 'Zip Code', ['class' => 'field-label']) !!}
        {!! Form::text('addr_zip', NULL, ['class' => 'text-field']) !!}
      </div>
      <div class="form-item">
        {!! Form::label('country', 'Country', ['class' => 'field-label']) !!}
        {!! Form::text('country', NULL, ['class' => 'text-field']) !!}
      </div>
    </div>
  </li>
  <li>
    <div class="figure__body">
      {!! Form::label('source', 'Signup Source', ['class' => 'field-label']) !!}
      <label class="option -radio">
        {!! Form::radio('source', 'agg', false) !!}
        <span class="option__indicator"></span>
        {!! Form::label('Agg') !!}
      </label>
      <label class="option -radio">
        {!! Form::radio('source', 'cgg', false) !!}
        <span class="option__indicator"></span>
        {!! Form::label('Cgg') !!}
      </label>
      <label class="option -radio">
        {!! Form::radio('source', 'drupal', false) !!}
        <span class="option__indicator"></span>
        {!! Form::label('Drupal') !!}
      </label>
      <label class="option -radio">
        {!! Form::radio('source', 'services', false) !!}
        <span class="option__indicator"></span>
        {!! Form::label('Services') !!}
      </label>
    </div>
  </li>
</ul>
  {!! Form::submit('Search', ['class' => 'button -secondary'])!!}
  {!! Form::close() !!}
</div>
