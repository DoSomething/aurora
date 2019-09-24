<div class="profile-section">
    <h3>Identity</h3>
    @include('users.partials.field', ['label' => 'ID', 'field' => 'id'])
    @include('users.partials.field', ['label' => 'Email', 'field' => 'email'])
    @include('users.partials.field', ['label' => 'Mobile', 'field' => 'mobile'])
</div>
<div class="profile-section">
    <h3>Profile</h3>
    @include('users.partials.field', ['label' => 'First Name', 'field' => 'first_name'])
    @include('users.partials.field', ['label' => 'Last Name', 'field' => 'last_name'])
    @include('users.partials.field', ['label' => 'Birthdate', 'field' => 'birthdate'])
    @include('users.partials.field', ['label' => 'Voter Registration Status', 'field' => 'voter_registration_status'])
</div>
<div class="profile-section">
    <h4>Address:</h4>
    @if ($user->addr_street1 || $user->addr_street2 || $user->addr_city || $user->addr_state || $user->addr_zip || $user->country)
    <p>
        {{ $user->addr_street1 }} {{ $user->addr_street2 }}
        {{ $user->addr_city or 'N/A' }}, {{ $user->addr_state or 'N/A' }} {{ $user->addr_zip }}
        {{ $user->country }}
    </span>
    @else
    <p>&mdash;</p>
    @endif

</div>
