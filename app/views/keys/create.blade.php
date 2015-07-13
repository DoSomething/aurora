@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'Create a New App', 'subtitle' => ''])

<div class="container -padded">
  <div class="wrapper">
		<div class ="container -padded">
		  {{ Form::open(['route' => 'keys.store', 'method' => 'post']) }}
				<div class="container__block -half">
				  <div class="form-item -padded">
					  {{ Form::label('App Name', null, ['class' => 'field-label']) }}

				    {{ Form::text('app_name', NULL, ['class' => 'text-field']) }}
					</div>
				    {{ Form::submit('Submit', ['class' => 'button']) }}
				</div>
		  {{ Form::close() }}
		</div>
	</div>
</div>

@stop
