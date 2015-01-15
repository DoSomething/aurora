@extends('layout.master')

@section('main_content')

 @foreach($user as $key => $field)
  @if (!in_array($key, ['created_at', 'updated_at', 'campaigns']))
     <dt><strong>{{ $key }}</strong> </dt>
     <dl> {{ $field }} </dl>
   @endif

  @if ($key == 'campaigns')
    @foreach($field as $campaigns)
      {{var_dump($campaigns)}}
    @endforeach
  @endif
 @endforeach

@stop
