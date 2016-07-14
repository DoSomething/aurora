@extends('layout.master')

@section('main_content')

    @include('layout.header', ["header" => "Superusers", "subtitle" => "With great power comes great responsibility."])

    <div class="container -padded">
        <div class="wrapper">
            <div class="container__block -narrow">
                <p>This is a listing of all users with elevated privileges in Northstar. This determines their access
                and abilities across OAuth client applications.</p>
            </div>
            @foreach($users as $role => $group)
                <div class="container__block">
                    <h1>{{ ucwords($role) }} users</h1>
                    @include('users.partials.index-table', ['users' => $group])
                    {!! $group->links(\Aurora\Http\Presenters\ForgePaginationPresenter::class) !!}
                </div>
            @endforeach
        </div>
    </div>
@stop
