@extends('layout.master')

@section('main_content')
<header class="header" role="banner">
  <div class="wrapper">
    <h1 class="header__title">
      Create a New App
    </h1>
  </div>
</header>
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
