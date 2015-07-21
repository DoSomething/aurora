@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'Permission denied', 'subtitle' => ''])
	<div class="container -padded">
		<div class="wrapper">
			<div class="container__block">
				<h2>You need admin privileges to view this page!</h2>
				<iframe src="//giphy.com/embed/{{ $gif }}" width="480" height="384" frameBorder="0" style="max-width: 100%" class="giphy-embed" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
			</div>
		</div>
	</div>

@stop