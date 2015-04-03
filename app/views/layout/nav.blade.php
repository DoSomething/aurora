<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Aurora</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        @if (Auth::user())
          <li> {{ link_to_route('keys.index', 'Keys') }} </li>
          <li> {{ link_to_route('users.index', 'Users') }} </li>
          <li> {{ link_to_route('logout', 'Logout') }} </li>
        @else
          <li> {{ link_to_route('login', 'Login') }} </li>
        @endif
      </ul>
    </div>
  </div>
</nav>
