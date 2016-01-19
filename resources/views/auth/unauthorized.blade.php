@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'Permission denied', 'subtitle' => 'You don\'t have the proper privileges to do this!'])
	<div class="container -padded">
		<div class="wrapper">
			<div class="container__block -narrow">
                <p><strong>Aurora is only accessible to DoSomething.org staff members.</strong> It doesn't look like your
                user account has been granted permission to continue. If you think you should, ask in the <code>#api</code>
                Slack room.</p>
			</div>
		</div>
	</div>

@stop
