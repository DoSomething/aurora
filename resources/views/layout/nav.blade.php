<nav class="navigation -white -floating">
    <a class="navigation__logo" href="/"><span>DoSomething.org</span></a>
    <div class="navigation__menu">
        @if (Auth::user())
            <ul class="navigation__primary">
                <li>
                    <a href="{{ route('users.index') }}">
                        <strong class="navigation__title">Users</strong>
                        <span class="navigation__subtitle">Member profiles</span>
                    </a>
                </li>
                @if (Auth::user()->hasRole('admin'))
                    <li>
                        <a href="{{ route('clients.index') }}">
                            <strong class="navigation__title">OAuth Clients</strong>
                            <span class="navigation__subtitle">Northstar apps</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('superusers.index') }}">
                            <strong class="navigation__title">Superusers</strong>
                            <span class="navigation__subtitle">Admins, staff, etc.</span>
                        </a>
                    </li>
                @endif
            </ul>
            <ul class="navigation__secondary">
                <li><a href="/auth/logout">Log Out</a> </li>
            </ul>
        @endif
    </div>
</nav>
