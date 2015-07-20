<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Aurora</title>
  <!-- include bootstrap -->
  <!-- @TODO include this with gulp, grunt, etc. -->

  <link rel="stylesheet" href="{{ asset('assets/vendor/neue/neue.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/modal/modal.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/custom-neue.css') }}">
  <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
  <script src="{{ asset('/assets/vendor/neue/modernizr.js') }}"></script>
</head>

<body class="modernizr-no-js">
  <div class="chrome">
    <div class="wrapper">

      @include('layout.nav')

      @yield('main_content')

    </div>
  </div>
</body>

<script src="{{ asset('/assets/vendor/neue/neue.js') }}"></script>
<script src="{{ asset('/assets/vendor/modal/modal.js') }}"></script>

</html>
