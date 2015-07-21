@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'Permission denied', 'subtitle' => 'You need admin privileges to view this page!'])
	<div class="container -padded">
		<div class="wrapper">
			<div class="container__block">
				<h2>You need admin privileges to view this page!</h2>
			</div>
		</div>
	</div>

@stop