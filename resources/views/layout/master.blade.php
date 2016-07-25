<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Aurora</title>

    <link rel="stylesheet" href="{{ asset('dist/app.css') }}">
    <script src="{{ asset('/assets/vendor/neue/modernizr.js') }}"></script>
</head>

<body class="modernizr-no-js">
<!-- for flash messages -->
@if (Session::has('flash_message'))
    <div class="{{ Session::get('flash_message')['class'] }}">
        <em>{{ Session::get('flash_message')['text'] }}</em>
    </div>
@endif

<div class="chrome">
    <div class="wrapper">
        @include('layout.nav')

        @yield('main_content')
    </div>
</div>
</body>

<script src="{{ asset('/dist/app.js') }}"></script>

</html>
