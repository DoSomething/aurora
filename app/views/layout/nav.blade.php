<nav class="navigation -white -floating">
  <a class="navigation__logo" href="/"><span>DoSomething.org</span></a>
  <div class="navigation__menu">
    <ul class="navigation__primary">
      @if (Auth::user())
        <li>
          <a href="{{ route('users.index') }}">
            <strong class="navigation__title">Users</strong>
            <span class="navigation__subtitle">View all users</span>
          </a>
        </li>
        @if (Auth::user()->hasRole('admin'))
          <li>
            <a href="{{ route('keys.index') }}">
              <strong class="navigation__title">Keys</strong>
              <span class="navigation__subtitle">Northstar API Keys</span>
            </a>
          </li>
          <li>
            <a href="{{ url('/admins') }}">
              <strong class="navigation__title">Staff</strong>
              <span class="navigation__subtitle">View all aurora users</span>
            </a>
          </li>
        @endif
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

@include('sessions.signin-modal')
