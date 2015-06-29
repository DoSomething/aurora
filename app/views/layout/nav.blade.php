  <nav class="navigation {{'modifier_class'}}">
    <a class="navigation__logo" href=""><span>DoSomething.org</span></a>
    <div class="navigation__menu">
    <ul class="navigation__primary">
      <li>
        <h1 id="brand-title">Aurora</h1>
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
           <!-- {{ link_to_route('login', 'Login') }} -->

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
