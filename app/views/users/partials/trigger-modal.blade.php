@if (Session::has('trigger_modal'))
  {{ autoOpenModal() }}
@endif

@if (Session::has('flash_message'))
  <div class="{{ Session::get('flash_message')['class'] }}">
    <em>{{ Session::get('flash_message')['text'] }}</em>
  </div>
@endif