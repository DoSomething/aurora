@extends('layout.master')

@section('main_content')

    @include('layout.header', ['header' => 'OAuth Clients', 'subtitle' => 'Northstar application access & permissions'])

    <div class="container -padded">
        <div class="wrapper">
            <div class="container__block -narrow">
                <h1>Create Client</h1>

                @include('layout.errors')

                {!! Form::open(['route' => 'clients.store', 'method' => 'post']) !!}
                    <div class="form-item -padded">
                        {!! Form::label('title', 'Title', ['class' => 'field-label']) !!}
                        {!! Form::text('title', null, ['class' => 'text-field', 'placeholder' => 'What do we call this application?']) !!}
                    </div>

                    <div class="form-item -padded">
                        {!! Form::label('description', 'Description', ['class' => 'field-label']) !!}
                        {!! Form::textarea('description', null, ['class' => 'text-field', 'placeholder' => 'Explain what this client is used for!']) !!}
                    </div>

                    <div class="form-item -padded">
                        {!! Form::label('allowed_grant', 'Client Type', ['class' => 'field-label']) !!}
                        <div class="select">
                            {!! Form::select('allowed_grant', ['authorization_code' => 'Web (Authorization Code grant)', 'client_credentials' => 'Machine (Client Credentials grant)']) !!}
                        </div>
                        <em class="footnote">Use the Authorization Code grant
                            if a user is logging in and doing things (e.g. the
                            website or an admin app). Use the Client
                            Credentials grant if a computer is acting on it's
                            own (e.g. a cron job or queue worker).</em>
                    </div>

                    <div class="form-item -padded">
                        {!! Form::label('redirect_uri', 'Redirect URI', ['class' => 'field-label']) !!}
                        {!! Form::text('redirect_uri', null, ['class' => 'text-field', 'placeholder' => 'https://app.dosomething.org/login']) !!}
                        <em class="footnote">Required for Authorization Code
                            grant. This is a comma-separated list of URLs that
                            start the login flow.</em>
                    </div>

                    <div class="form-item -padded">
                        {!! Form::label('client_id', 'Client ID', ['class' => 'field-label']) !!}
                        {!! Form::text('client_id', null, ['class' => 'text-field', 'placeholder' => 'client-id']) !!}
                        <span class="footnote">Careful, this cannot be changed later!</span>
                    </div>

                    <div class="form-item -padded">
                        {!! Form::label('client_secret', 'Client Secret', ['class' => 'field-label']) !!}
                        {!! Form::text('client_secret', '<randomly generated>', ['class' => 'text-field', 'disabled' => true]) !!}
                    </div>

                    <div class="form-item -padded">
                        {!! Form::label('scope', 'Allowed Scopes', ['class' => 'field-label']) !!}
                        @foreach($scopes as $scope => $details)
                            <label class="option -checkbox">
                                {!! Form::checkbox('scope['.$scope.']', $scope) !!}
                                <span class="option__indicator"></span>
                                <span><strong>{{ $scope }}</strong> – {{ $details['description'] }}
                                    @if(! empty($details['hint']))
                                        <em class="footnote">
                                            {{ $details['hint'] }}
                                        </em>
                                    @endif
                                </span>
                            </label>
                        @endforeach
                    </div>
                    {!! Form::submit('Submit', ['class' => 'button']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop
