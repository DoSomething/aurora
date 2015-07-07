<nav class="navigation -white -floating">
  <a class="navigation__logo" href="/"><span>DoSomething.org</span></a>
  <div class="navigation__menu">
  <ul class="navigation__primary">
    @if (Auth::user())
      <li><strong class="navigation__title">{{ link_to_route('keys.index', 'Keys') }} </strong></li>
      <li><strong class="navigation__title"> {{ link_to_route('users.index', 'Users') }} </strong></li>
    @endif
  </ul>
  <ul class="navigation__secondary">
    <li>
    @if (Auth::user())
      <li> {{ link_to_route('logout', 'Logout') }} </li>
    @else
      <li>
        <a href="#" data-modal-href="#signin-modal" class="signinModal">Login</a>
     </li>
    @endif
  </li>
  </ul>
  </div>
</nav>

<header class="header" role="banner">
  <div class="wrapper">
    <h1 class="header__title">
      Aurora
    </h1>
    <p class="header__subtitle">
      User admin tool to view Northstar users
    </p>
  </div>
</header>

@include('sessions.create')