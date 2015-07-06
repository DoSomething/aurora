<nav class="navigation">
  <a class="navigation__logo" href="/"><span>DoSomething.org</span></a>
  <div class="navigation__menu">
  <ul class="navigation__primary">
    <li>
      <a href="."><h1 class="heading -hero">Aurora</h1></a>
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
      <li>
        <!-- Modal Stuff  -->
        <a href="#" data-modal-href="#signin-modal" class="signinModal">Login</a>
        <!-- Modal Stuff -->
     </li>
    @endif
  </li>
  </ul>
  </div>
</nav>
   @include('sessions.create')
