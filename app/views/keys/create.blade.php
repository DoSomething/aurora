@extends('layout.master')

@section('main_content')

<div class ="container -padded">
  {{ Form::open(['route' => 'keys.store', 'method' => 'post']) }}

		<div class="container__block -half">
			<h1 class="heading -alpha">Create a New App</h1>
			  <div class="form-item -padded">
				  {{ Form::label('App Name', null, ['class' => 'field-label']) }}

			    {{ Form::text('app_name', NULL, ['class' => 'text-field']) }}
				</div>
			    {{ Form::submit('Submit', ['class' => 'button']) }}
		</div>

  {{ Form::close() }}
</div>

@stop
