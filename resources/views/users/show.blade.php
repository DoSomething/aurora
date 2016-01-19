@extends('layout.master')

@section('main_content')

    @include('layout.header', ['header' => 'Users', 'subtitle' => 'View & edit member profiles.']);

    <div class="container -padded">
        <div class="wrapper">
            <div class="container__block">
                <h1>{{ $northstar_profile['first_name'] or $northstar_profile['_id'] }}</h1>
                @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('staff'))
                    <dt><a href="{{ url('users/' . $northstar_profile['_id'] . '/edit') }}">Edit User</a></dt>
                @endif
            </div>

            @include('users.partials.details')
        </div>
    </div>

    <div class="container -padded">
        <div class="wrapper">
            @if((\Aurora\Models\User::where('_id',$northstar_profile['_id'])->first()))
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
