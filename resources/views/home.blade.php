@extends('layout.master')

@section('main_content')

    @include('layout.header', ['header' => 'Administration', 'subtitle' => 'Please log in to continue.'])

    <div class="container -padded">
        <div class="wrapper">
            <div class="container__block -narrow">
                <p>
                    Welcome to the <strong>DoSomething.org admin interface</strong>. If you're looking to
                    manage user accounts or domain redirects, you're in the right place.
                </p>
                <p>Drop a message in the <code>#help-web-template</code> Slack room if you can't log in!</p>

                <p>
                    <a href="/auth/login" class="button">Log In</a>
                </p>
        </div>
    </div>

@stop
