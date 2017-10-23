@extends('layout.master')

@section('main_content')

    @include('layout.header', ['header' => 'Users', 'subtitle' => 'View & edit member profiles.'])

    <div class="container">
        <div class="wrapper">
            <div class="container__block">
                <h1>{{ $user->displayName() }}</h1>
                @include('layout.errors')
            </div>

            <div class="container__block -half profile-settings">
                <h3>Profile</h3>
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
            </div>
            <div class="container__block -half">
                <div class="container -padded">
                    @if(Auth::user()->hasRole('admin'))
                        <div class="danger-zone">
                            <h4 class="danger-zone__heading">Danger Zone&#8482;</h4>
                            <div class="danger-zone__block">
                                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE']) !!}
                                <div class="form-item">
                                    <label for="role" class="field-label">Delete Account</label>
                                    <p class="footnote">This will <strong>permanently remove</strong> a user's account from Northstar.
                                        This is the point of no return! Beware!</p>
                                </div>
                                <div class="form-actions">
                                    {!! Form::submit('Delete User', ['class' => 'button -secondary -danger']) !!}
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    @endif
                </div>
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
            <div class="container__block -narrow profile-settings">
                <h3>Connected Accounts</h3>
                @if(! empty($user->drupal_id))
                    <dt>Phoenix:</dt><dd><a href="{{ config('services.drupal.url') }}/user/{{ $user->drupal_id }}">{{ $user->drupal_id }}</a></dd>
                @else
                    <dt>Phoenix:</dt><dd>&mdash;</dd>
                @endif

                <dt>Gladiator:</dt><dd><a href="{{ config('services.gladiator.url') }}/users/{{ $user->id }}">{{ $user->id }}</a></dd>

                @if(! empty($user->mobilecommons_id))
                    <dt>Mobile Commons:</dt><dd><a href="https://secure.mcommons.com/profiles/{{ $user->mobilecommons_id }}">{{ $user->mobilecommons_id }}</a></dd>
                @else
                    <dt>Mobile Commons:</dt><dd>&mdash;</dd>
                @endif
            </div>
        </div>
    </div>
@stop
