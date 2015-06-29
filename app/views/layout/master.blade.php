<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Aurora</title>
  <!-- include bootstrap -->
  <!-- @TODO include this with gulp, grunt, etc. -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="{{ asset('assets/vendor/neue/neue.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/neue/custom-neue.css') }}">
  <script src="{{ asset('/assets/vendor/neue/neue.js') }}"></script>
</head>
<body>

  @include('layout.nav')


  @if (Session::has('flash_message'))
    <div class="flash-message {{ Session::get('flash_message')['class'] }}">
      <em>{{ Session::get('flash_message')['text'] }}</em>
    </div>
  @endif

  <div class="container">
    @yield('main_content')
 </div>

</body>

<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</html>
