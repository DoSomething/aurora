@extends('layout.master')

@section('main_content')

    @include('layout.header', ['header' => 'Users', 'subtitle' => 'View & edit member profiles.'])

    <div class="container">
        <div class="wrapper">
            <div class="container__block">
                <h1>{{ $user->displayName() }}</h1>
            </div>

            <div class="container__block -half profile-settings">
                <h3>Profile</h3>
                <dt>ID:</dt><dd>{{ $user->id }}</dd>
                <dt>Drupal ID:</dt><dd>{{ $user->drupal_id or '&mdash;' }}</dd>
                <dt>Source:</dt><dd>{{ $user->source or '&mdash;' }}</dd>
                <dt>First Name:</dt><dd>{{ $user->first_name or '&mdash;' }}</dd>
                <dt>Last Name:</dt><dd>{{ $user->last_name or '&mdash;' }}</dd>
                <dt>Email:</dt><dd>{{ $user->email or '&mdash;' }}</dd>
                <dt>Mobile:</dt><dd>{{ $user->mobile or '&mdash;' }}</dd>
                <dt>Birthdate:</dt><dd>{{ $user->birthdate or '&mdash;' }}</dd>

                @if (isset($user->addr_street1) || isset($user->addr_street2) || isset($user->addr_city) || isset($user->addr_state) || isset($user->addr_zip) )
                    <dt>Address:</dt><dd>{{ $user->addr_street1 or '' }} {{ $user->addr_street2 or '' }} {{ $user->addr_city or '' }} {{ $user->addr_state or '' }} {{ $user->addr_zip or '' }}</dd>
                @endif

                <dt>Country:</dt><dd>{{ $user->country or '&mdash;' }}</dd>
            </div>
            <div class="container__block -half">
                <article class="figure -left">
                    <div class="container -padded">
                    @if(Auth::user()->hasRole('admin'))
                        @include('users.partials.assign-role')
                    @endif
                </article>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="wrapper">
            <div class="container__block -half">
                @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('staff'))
                    <a class="secondary" href="{{ url('users/' . $user->id . '/edit') }}">Update user's profile</a>
                @endif
                <p class="footnote">
                    Last updated: {{ $user->updated_at->format('F d, Y g:ia') }}<br />
                    Created: {{ $user->created_at->format('F d, Y g:ia') }}
                </p>
            </div>
        </div>
    </div>

    <div class="container -padded">
        <div class="wrapper">
            @if($user->auroraUser())
                <div class="container__block profile-settings">
                    <h3>Aurora Profile</h3>
                    <dt>Role:</dt> <dd>{{ value(array_slice($user_roles, -1, 1)[0]) }}</dd>
                </div>
            @endif
        </div>
    </div>

    <div class="container -padded">
        <div class="wrapper">
            <div class="container__block">
                <h3>Campaigns</h3>
                @include('users.partials.campaigns')
            </div>
        </div>
    </div>

    <div class="container -padded">
        <div class="wrapper">
            <div class="container__block">
                <h3>Reportbacks</h3>
                @include('users.partials.reportbacks')
            </div>
        </div>
    </div>

@stop
