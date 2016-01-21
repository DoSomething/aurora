{!! Form::open(['action' => 'UsersController@search', 'method' => 'GET']) !!}
<div class="form-actions -inline">
    <li>{!! Form::text('query', request()->get('query'), ['class' => 'text-field -search', 'placeholder' => 'Search by email, mobile, Drupal ID…', 'style' => 'min-width: 400px']) !!}</li>
    <li>{!! Form::submit('Search', ['class' => 'button']) !!}</li>
</div>
{!! Form::close () !!}
