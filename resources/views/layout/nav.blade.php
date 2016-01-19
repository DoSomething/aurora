<nav class="navigation -white -floating">
    <a class="navigation__logo" href="/"><span>DoSomething.org</span></a>
    <div class="navigation__menu">
        <ul class="navigation__primary">
            @if (\Auth::user())
                <li>
                    <a href="{{ route('users.index') }}">
                        <strong class="navigation__title">Users</strong>
                        <span class="navigation__subtitle">Member profiles</span>
                    </a>
                </li>
                @if (\Auth::user()->hasRole('admin'))
                    <li>
                        <a href="{{ route('keys.index') }}">
                            <strong class="navigation__title">API Keys</strong>
                            <span class="navigation__subtitle">Northstar apps</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/admins') }}">
                            <strong class="navigation__title">Aurora Users</strong>
                            <span class="navigation__subtitle">Admins, staff, etc.</span>
                        </a>
                    </li>
                @endif
            @endif
        </ul>
        <ul class="navigation__secondary">
            @if (Auth::user())
                <li><a href="/auth/logout">Log Out</a> </li>
            @endif
        </ul>
    </div>
</nav>
