<header class="header" role="banner">
  <div class="wrapper">
    <h1 class="header__title">
      {{ $header }}
    </h1>
    <p class="header__subtitle">
      {{ $subtitle }}
    </p>
  </div>
</header>

<!-- for flash messages -->
@if (Session::has('flash_message'))
  <div class="{{ Session::get('flash_message')['class'] }}">
    <em>{{ Session::get('flash_message')['text'] }}</em>
  </div>
@endif

<!-- for log in failure  -->
@if (Session::has('trigger_modal'))
  <div class="{{ Session::get('trigger_modal')['class'] }}">
    <em>{{ Session::get('trigger_modal')['text'] }}</em>
  </div>
@endif
