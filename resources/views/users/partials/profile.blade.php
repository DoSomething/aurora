<dt>ID:</dt><dd>{{ $user->id }}</dd>
<dt>Email:</dt><dd>{{ $user->email or '&mdash;' }}</dd>
<dt>Mobile:</dt><dd>{{ $user->prettyMobile('&mdash;') }}</dd>
<dt>First Name:</dt><dd>{{ $user->first_name or '&mdash;' }}</dd>
<dt>Last Name:</dt><dd>{{ $user->last_name or '&mdash;' }}</dd>
<dt>Birthdate:</dt><dd>{{ $user->birthdate or '&mdash;' }}</dd>
<dt>Source:</dt><dd>{{ $user->source or '&mdash;' }}</dd>

@if (isset($user->addr_street1) || isset($user->addr_street2) || isset($user->addr_city) || isset($user->addr_state) || isset($user->addr_zip) )
    <dt>Address:</dt><dd>{{ $user->addr_street1 or '' }} {{ $user->addr_street2 or '' }} {{ $user->addr_city or '' }} {{ $user->addr_state or '' }} {{ $user->addr_zip or '' }}</dd>
@else
    <dt>Address:</dt><dd>&mdash;</dd>
@endif

<dt>SMS Status:</dt><dd>{{ $user->sms_status or '&mdash;' }}</dd>
<dt>SMS Paused:</dt><dd>{{ $user->sms_paused ? '✔' : '✘' }}</dd>
<dt>Country:</dt><dd>{{ $user->country or '&mdash;' }}</dd>
<dt>Role:</dt><dd>{{ $user->role or '&mdash;' }}</dd>
