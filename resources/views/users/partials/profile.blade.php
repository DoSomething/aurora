<div class="profile-section">
    <h3>Identity</h3>
    @include('users.partials.field', ['label' => 'ID', 'field' => 'id'])
    @include('users.partials.sensitive-field', ['field' => 'email', 'preview_field' => 'email_preview'])
    @include('users.partials.sensitive-field', ['field' => 'mobile', 'preview_field' => 'mobile_preview'])
</div>
<div class="profile-section">
    <h3>Profile</h3>
    @include('users.partials.field', ['label' => 'First Name', 'field' => 'first_name'])
    @include('users.partials.sensitive-field', ['label' => 'Last Name', 'field' => 'last_name', 'preview_field' => 'last_initial', 'preview_suffix' => '.'])
    @include('users.partials.sensitive-field', ['field' => 'birthdate', 'preview_field' => 'age', 'preview_suffix' => ' years old'])
    @include('users.partials.field', ['label' => 'Voter Registration Status', 'field' => 'voter_registration_status'])
    @include('users.partials.sensitive-field', ['label' => 'School ID', 'preview_field' => 'school_id_preview', 'field' => 'school_id'])
    @include('users.partials.field', ['label' => 'Club ID', 'field' => 'club_id'])
</div>
<div class="profile-section">
    <h4>Address:</h4>
    @if ($user->addr_street1 || $user->addr_street2 || $user->addr_city || $user->addr_state || $user->addr_zip || $user->country)
    <p>
        @if (Str::contains(request()->query('include'), ['addr_street1', 'addr_street2']))
            {{ $user->addr_street1 ?? 'N/A' }} {{ $user->addr_street2 }}<br/>
        @endif
        {{ $user->addr_city ?? 'N/A' }}, {{ $user->addr_state ?? 'N/A' }} {{ $user->addr_zip }}
        {{ revealer('addr_street1', 'addr_street2') }}
        <br/>
        {{ $user->country ? country_name($user->country) : 'N/A' }}
    </span>
    @else
    <p>&mdash;</p>
    @endif

</div>
