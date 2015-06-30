<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Aurora</title>
  <!-- include bootstrap -->
  <!-- @TODO include this with gulp, grunt, etc. -->

  <link rel="stylesheet" href="{{ asset('assets/vendor/neue/neue.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/modal/modal.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/neue/custom-neue.css') }}">
  <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
  <script src="{{ asset('/assets/vendor/neue/modernizr.js') }}"></script>
</head>

<body class="modernizr-no-js">
  <div class="chrome">
    @include('layout.nav')
    @if (Session::has('flash_message'))
      @if (Session::get('flash_message')['text'] === "Login Failed")
        <script>
          $(document).ready(function () {
            window.DSModal.open($("#signin-modal"));
          });
        </script>
      @endif
      <div class="flash-message {{ Session::get('flash_message')['class'] }}">
        <em>{{ Session::get('flash_message')['text'] }}</em>
      </div>
    @endif
    <div class="container">
      @yield('main_content')
    </div>
  </div>
</body>

<script src="{{ asset('/assets/vendor/neue/neue.js') }}"></script>
<script src="{{ asset('/assets/vendor/modal/modal.js') }}"></script>

</html>
