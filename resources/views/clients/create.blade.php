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
                        {!! Form::text('title', null, ['class' => 'text-field', 'placeholder' => 'What\'s this client called?']) !!}
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
                    </div>

                    <div class="form-item -padded">
                        {!! Form::label('redirect_uri', 'Redirect URI', ['class' => 'field-label']) !!}
                        {!! Form::text('redirect_uri', null, ['class' => 'text-field', 'placeholder' => 'https://app.dosomething.org/login']) !!}
                        <em class="footnote">This is a comma-separated list of URLs that can be used to login with this client.</em>
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
                                <span><strong>{{ $scope }}</strong> – {{ $details['description'] }} <em class="footnote">{{ isset($details['warning']) && $details['warning'] ? '(Careful, don\'t use this scope with untrusted clients!)' : '' }}</em></span>
                            </label>
                        @endforeach
                    </div>
                    {!! Form::submit('Submit', ['class' => 'button']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop
