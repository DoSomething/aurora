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

<!-- for log in failure  -->
@if (Session::has('trigger_modal'))
  <div class="{{ Session::get('trigger_modal')['class'] }}">
    <em>{{ Session::get('trigger_modal')['text'] }}</em>
  </div>
@endif
