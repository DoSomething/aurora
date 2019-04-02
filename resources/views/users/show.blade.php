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
                <h3>Links</h3>
                <ul>
                    <li>
                        <a href="{{ config('services.customerio.profile_url') }}/{{ $user->id }}">Customer.io</a>
                    </li>
                    <li>
                        <a href="{{ config('services.gambit.profile_url') }}/{{ $user->id }}">Gambit</a>
                    </li>
                    <li>
                        <a href="{{ config('services.rogue.profile_url') }}/{{ $user->id }}">Rogue</a>
                    </li>
            </div>
        </div>
    </div>
@stop
