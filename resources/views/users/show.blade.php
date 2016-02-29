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
                <dt>Mobile:</dt><dd>{{ $user->prettyMobile('&mdash;') }}</dd>
                <dt>Birthdate:</dt><dd>{{ $user->birthdate or '&mdash;' }}</dd>

                @if (isset($user->addr_street1) || isset($user->addr_street2) || isset($user->addr_city) || isset($user->addr_state) || isset($user->addr_zip) )
                    <dt>Address:</dt><dd>{{ $user->addr_street1 or '' }} {{ $user->addr_street2 or '' }} {{ $user->addr_city or '' }} {{ $user->addr_state or '' }} {{ $user->addr_zip or '' }}</dd>
                @else
                    <dt>Address:</dt><dd>&mdash;</dd>
                @endif

                <dt>Country:</dt><dd>{{ $user->country or '&mdash;' }}</dd>
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
            @if($auroraUser)
                <div class="container__block profile-settings">
                    <h3>Aurora Profile</h3>
                    <dt>Role:</dt> <dd>{{ !empty($auroraUser->role) ? $auroraUser->role : '&mdash;' }}</dd>
                </div>

                @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('staff'))
                    <div class="container__block">
                        <a class="secondary" href="{{ url('aurora-users/' . $auroraUser->id . '/edit') }}">Update Aurora profile</a>
                    </div>
                @endif

            @endif
        </div>
    </div>
@stop
