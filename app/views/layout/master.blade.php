<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Aurora</title>
  <!-- include bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</head>

<body>

  @include('layout.nav')

  @yield('main_content')
</body>

</html>
