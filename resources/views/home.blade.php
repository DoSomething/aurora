@extends('layout.master')

@section('main_content')

    @include('layout.header', ['header' => 'Aurora', 'subtitle' => 'Please log in to continue.'])

    <div class="container -padded">
        <div class="wrapper">
            <div class="container__block -narrow">
                <p>
                    This is <strong>Aurora</strong>, our user admin tool. It's the graphical front-end to
                    <a href="https://github.com/DoSomething/northstar">Northstar</a>, our user & activity API.
                    Aurora is only available to DoSomething.org staff members.
                </p>
                <p>Drop a message in the <code>#api</code> Slack room if you can't log in!</p>

                <p>
                    <a href="/auth/login" class="button">Log In</a>
                </p>
        </div>
    </div>

@stop
