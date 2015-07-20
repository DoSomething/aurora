<div data-modal id="signin-modal" role="dialog">
  <h2 class="heading -banner">Please Sign In</h2>
  @if (Session::has('trigger_modal'))
    <div class="{{ Session::get('trigger_modal')['class'] }}">
      <em>{{ Session::get('trigger_modal')['text'] }}</em>
    </div>
  @endif
  <div class="modal__block">
    @include('sessions.partials.login-form')
  </div>
</div>
