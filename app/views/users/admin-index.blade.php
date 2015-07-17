@extends('layout.master')

@section('main_content')

@include('layout.header', ["header" => "Admin Index", "subtitle" => "Listing of all admins"])

<h1 class="heading -banner"><span>Account Info</span></h1>
<div class="container -padded">
  <div class="wrapper">
		@forelse($admins as $admin)
			{{$admin['first_name'] or '' }}
			{{$admin['last_name'] or '' }}
			{{$admin['email'] or '' }}
		@empty
		No Admin
		@endforelse
	</div>
</div>
@stop
