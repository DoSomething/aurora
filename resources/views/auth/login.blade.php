@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'Aurora', 'subtitle' => 'Please log in to continue.'])

<div class="container -padded">
	<div class="wrapper">
		<div class="container__block -narrow">
            <p>
                This is <strong>Aurora</strong>, our user admin tool. It's the graphical front-end to
                <a href="https://github.com/DoSomething/northstar">Northstar</a>, our user & activity API.
                Aurora is only available to DoSomething.org staff members.
                </p>
            <p>Drop a message in the <code>#api</code> Slack room if you can't log in!</p>

            @include('layout.errors')

            {!! Form::open(['url' => '/auth/login', 'method' => 'POST', 'class' => 'form-signin']) !!}
            <div class="form-item -padded">
                {!! Form::label('username', 'Email address or cell number', array('class' => 'field-label')) !!}
                {!! Form::text('username', NULL, array('class' => 'text-field', 'placeholder' => 'puppet-sloth@dosomething.org')) !!}
            </div>
            <div class="form-item -padded">
                {!! Form::label('password', 'Password', array('class' => 'field-label')) !!}
                {!! Form::password('password', array('class' => 'text-field', 'placeholder' => '•••••••')) !!}
            </div>
            <ul class="form-actions -inline -padded">
                <li>{!! Form::submit('Log In', array('class' => 'button')) !!}</li>
                <li>
                    <div class="message-callout -right">
                        <div class="message-callout__copy">
                            <p>Staff only!</p>
                        </div>
                    </div>
                </li>
            </ul>
            {!! Form::close() !!}
		</div>
	</div>
</div>

@stop
