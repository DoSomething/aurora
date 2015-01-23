@extends('layout.master')

@section('main_content')

<h3> {{ $user['first_name'] }}</h3>
<a href="{{ url('users/' . $user['_id'] . '/edit') }}"> Edit User <span class="glyphicon glyphicon-pencil"></span></a>
@if ($aurora_user)
  Admin: {{ $aurora_user->hasRole('admin') ? '✓' : 'x' }}
  @if (!$aurora_user->hasRole('admin'))
    {{ Form::open(['route' => array('admin.create', $aurora_user->id)]) }}
    {{ Form::submit('make admin') }}
    {{ Form::close() }}
  @endif
@endif

<div class="container">
   @foreach($user as $key => $field)
    @if (!in_array($key, ['created_at', 'updated_at', 'campaigns']))
      @if (!empty($field))
         <dt class="control-label col-sm-2"><strong>{{ $key }}</strong> </dt>
         <dl> {{ $field }} </dl>
       @endif
     @endif

    @if ($key == 'campaigns')
      @foreach($field as $campaigns)
        {{var_dump($campaigns)}}
      @endforeach
    @endif
   @endforeach
</div>
@stop
