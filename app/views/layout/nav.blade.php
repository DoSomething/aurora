<nav class="navigation {{'modifier_class'}}">
  <a class="navigation__logo" href="http://www.dosomething.org"><span>DoSomething.org</span></a>
  <div class="navigation__menu">
  <ul class="navigation__primary">
    <li>
      <h1><strong>Aurora</strong></h1>
    </li>
  </ul>
  <ul class="navigation__secondary">
    <li>
      <form action="#" method="post">
        <input class="text-field -search" type="search">
      </form>
    </li>
    <li>
    @if (Auth::user())
      <li> {{ link_to_route('keys.index', 'Keys') }} </li>
      <li> {{ link_to_route('users.index', 'Users') }} </li>
      <li> {{ link_to_route('logout', 'Logout') }} </li>
    @else
      <li> {{ link_to_route('login', 'Login') }} </li>
    @endif
    </li>
  </ul>
  </div>
</nav>
