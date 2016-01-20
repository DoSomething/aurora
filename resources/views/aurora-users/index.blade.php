@extends('layout.master')

@section('main_content')

    @include('layout.header', ["header" => "Aurora Users", "subtitle" => "Admins, staff, interns, etc."])

    @forelse($group as $role => $users)
        @if (!empty($group[$role]))
            <div class="container -padded">
                <div class="wrapper">
                    <div class="container__block">
                        <h1>{{ ucwords($role) }} users</h1>
                        @include('users.partials.index-table', ['users' => $users])
                    </div>
                </div>
            </div>
            @endif
            @empty
                <!-- Display Nothing -->
            @endforelse
@stop
