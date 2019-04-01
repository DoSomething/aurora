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
                <div class="container -padded">
                    <h3>Profile</h3>
                    @include('users.partials.profile')
                </div>
                <div class="container -padded">
                    <h3>Subscriptions</h3>
                    @include('users.partials.subscriptions')
                </div>
            </div>

            <div class="container__block -half">
                <div class="container -padded">
                    @if(Auth::user()->hasRole('admin'))
                      @include('users.partials.danger-zone')
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
