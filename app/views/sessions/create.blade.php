<div data-modal id="signin-modal" role="dialog">
  <h2 class="heading -banner">Please Sign In</h2>
  @if (Session::has('flash_message'))
  <div class="messages">
    <div class="flash-message {{ Session::get('flash_message')['class'] }}">
      <em>{{ Session::get('flash_message')['text'] }}</em>
    </div>
  </div>
  @endif
  <div class="modal__block">
  {{ Form::open(['route' => 'sessions.store', 'class' => 'form-signin']) }}
    <div class="form-item -padded">
      {{ Form::label('email', 'Email', array('class' => 'sr-only')) }}
      {{ Form::text('email', NULL, array('class' => 'text-field', 'placeholder' => 'Email Address')) }}
    </div>
    <div class="form-item -padded">
      {{ Form::label('password', 'Password', array('class' => 'sr-only')) }}
      {{ Form::password('password', array('class' => 'text-field', 'placeholder' => 'Password')) }}
    </div>
    {{ Form::submit('Sign in', array('class' => 'button')) }}
  {{ Form::close() }}
  </div>
</div>
