{!! Form::open(['route' => 'sessions.store', 'class' => 'form-signin']) !!}
	<div class="form-item -padded">
		{!! Form::label('email', 'Email', array('class' => 'sr-only')) !!}
		{!! Form::text('email', NULL, array('class' => 'text-field', 'placeholder' => 'Email Address')) !!}
	</div>
	<div class="form-item -padded">
		{!! Form::label('password', 'Password', array('class' => 'sr-only')) !!}
		{!! Form::password('password', array('class' => 'text-field', 'placeholder' => 'Password')) !!}
	</div>
	<div class="form-actions form-wrapper">
		{!! Form::submit('Sign in', array('class' => 'button')) !!}
	</div>
{!! Form::close() !!}
