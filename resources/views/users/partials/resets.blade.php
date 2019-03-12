{!! Form::open(['route' => ['users.resets.create', $user->id], 'method' => 'POST']) !!}
<div class="form-item">
    {!! Form::label('id', 'Password Resets', ['class' => 'field-label']) !!}
    <p class="footnote">Send a password reset email to the user.</p>
</div>
<div class="form-item -padded">
    <div class="select">
        {!! Form::select('type', [
                'forgot-password' => 'Forgot Password',
                'rock-the-vote-activate-account' => 'Rock The Vote Activate Account',
            ], null, ['placeholder' => '-- Select type -- ']) !!}
    </div>
</div>
<div class="form-actions">
    {!! Form::submit('Send email', ['class' => 'button -secondary']) !!}
</div>
