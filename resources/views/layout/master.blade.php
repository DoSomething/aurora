<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        {{ isset($title) ? $title . ' | Aurora' : 'Aurora' }}
    </title>

    <link rel="stylesheet" href="{{ elixir('app.css', 'dist') }}">
    <script src="{{ asset('dist/modernizr.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{ scriptify(auth()->user() ? auth()->user()->access_token : null, 'AUTH') }}
    <script src="{{ elixir('app.js', 'dist') }}"></script>
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

</html>
