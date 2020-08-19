@extends('layout.master')

@section('main_content')

    @include('layout.header', ['header' => 'OAuth Clients', 'subtitle' => 'Northstar application access & permissions'])

    <div class="container -padded">
        <div class="wrapper">
            <div class="container__block -narrow">
                <h1>{{ $client->title ?? Str::title($client->client_id) }}</h1>

                @include('layout.errors')

                <form action="{{ route('clients.update', $client->client_id) }}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-item -padded">
                        {!! Form::label('title', 'Title', ['class' => 'field-label']) !!}
                        {!! Form::text('title', $client->title, ['class' => 'text-field']) !!}
                    </div>

                    <div class="form-item -padded">
                        {!! Form::label('description', 'Description', ['class' => 'field-label']) !!}
                        {!! Form::textarea('description', $client->description, ['class' => 'text-field']) !!}
                    </div>

                    <div class="form-item -padded">
                        {!! Form::label('allowed_grant', 'Client Type', ['class' => 'field-label']) !!}
                        <div class="select">
                            {!! Form::select('allowed_grant', [
                                'authorization_code' => 'Web (Authorization Code grant)',
                                'client_credentials' => 'Machine (Client Credentials grant)'
                            ], $client->allowed_grant ) !!}
                        </div>
                        <em class="footnote">Use the Authorization Code grant
                            if a user is logging in and doing things (e.g. the
                            website or an admin app). Use the Client
                            Credentials grant if a computer is acting on it's
                            own (e.g. a cron job or queue worker).</em>
                    </div>

                    <div class="form-item -padded">
                        {!! Form::label('redirect_uri', 'Redirect URI', ['class' => 'field-label']) !!}
                        {!! Form::text('redirect_uri', array_to_csv($client->redirect_uri), ['class' => 'text-field']) !!}
                        <em class="footnote">Required for Authorization Code
                            grant. This is a comma-separated list of URLs that
                            start the login flow.</em>
                    </div>

                    <div class="form-item -padded">
                        {!! Form::label('scope', 'Allowed Scopes', ['class' => 'field-label']) !!}
                        @foreach($scopes as $scope => $details)
                            <label class="option -checkbox">
                                {!! Form::checkbox('scope['.$scope.']', $scope, in_array($scope, $client->scope)) !!}
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
                </form>

            </div>
            <div class="container__block -narrow">
                <br><br><br>
                <div class="danger-zone">
                    <h4 class="danger-zone__heading">Danger Zone&#8482;</h4>
                    <div class="danger-zone__block">
                        <div class="form-item">
                            <label for="role" class="field-label">Delete OAuth Client</label>
                            <p class="footnote">This will <strong>permanently delete</strong> this client, and it will no longer
                            be able to create new access or refresh tokens. All existing access tokens will be valid until their
                            expiration (up to 1 hour).
                        </div>

                        <a class="button -secondary -danger" href="{{ route('clients.destroy', $client->client_id) }}" data-method="DELETE" data-confirm="Are you sure you want to delete this OAuth client? This will prevent any users of this app from logging in or refreshing their access token.">Delete Client</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
