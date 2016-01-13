<ul class="gallery -duo">
    <li>
        <article class="figure -left">
            <dl class="profile-settings">
                <dt>Id:</dt><dd>{{{ $northstar_profile['_id'] }}}</dd>
                <dt>Drupal ID:</dt><dd>{{ $northstar_profile['drupal_id'] or '--' }}</dd>
                <dt>Source:</dt><dd>{{ $northstar_profile['source'] or '--' }}</dd>
                <dt>First Name:</dt><dd>{{ $northstar_profile['first_name'] or '--' }}</dd>
                <dt>Last Name:</dt><dd>{{ $northstar_profile['last_name'] or '--' }}</dd>
                <dt>Email:</dt><dd>{{ $northstar_profile['email'] or '--' }}</dd>
                <dt>Mobile:</dt><dd>{{ $northstar_profile['mobile'] or '--' }}</dd>
                <dt>Birthdate:</dt><dd>{{ $northstar_profile['birthdate'] or '--' }}</dd>

                @if (isset($northstar_profile['addr_street1']) || isset($northstar_profile['addr_street2']) || isset($northstar_profile['addr_city']) || isset($northstar_profile['addr_state']) || isset($northstar_profile['addr_zip']) )
                    <dt>Address:</dt><dd>{{ $northstar_profile['addr_street1'] or '' }} {{ $northstar_profile['addr_street2'] or '' }} {{ $northstar_profile['addr_city'] or '' }} {{ $northstar_profile['addr_state'] or '' }} {{ $northstar_profile['addr_zip'] or '' }}</dd>
                @endif

                <dt>Country:</dt><dd>{{ $northstar_profile['country'] or '--' }}</dd>
            </dl>
        </article>
    </li>
    <li>
        <article class="figure -left">
            <div class="container -padded">
            @if(Auth::user()->hasRole('admin'))
                @include('users.partials.assign-role')
                @include('users.partials.unsubscribe')
            @endif
        </article>
    </li>
</ul>
