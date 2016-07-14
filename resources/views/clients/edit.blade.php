@extends('layout.master')

@section('main_content')

    @include('layout.header', ['header' => 'OAuth Clients', 'subtitle' => 'Northstar application access & permissions'])

    <div class="container -padded">
        <div class="wrapper">
            <div class="container__block -narrow">
                <h1>{{ $client->title or title_case($client->client_id) }}</h1>

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
                        {!! Form::label('scope', 'Allowed Scopes', ['class' => 'field-label']) !!}
                        @foreach($scopes as $scope => $details)
                            <label class="option -checkbox">
                                {!! Form::checkbox('scope['.$scope.']', $scope, in_array($scope, $client->scope)) !!}
                                <span class="option__indicator"></span>
                                <span><strong>{{ $scope }}</strong> – {{ $details['description'] }} <em class="footnote">{{ isset($details['warning']) && $details['warning'] ? '(Careful, don\'t use this scope with untrusted clients!)' : '' }}</em></span>
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
                        <form action="{{ route('clients.destroy', $client->client_id) }}" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-item">
                                <label for="role" class="field-label">Delete Account</label>
                                <p class="footnote">This will <strong>permanently delete</strong> this client, and it will no longer
                                be able to create new access or refresh tokens. All existing tokens will continue to function until
                                their expiration (up to 1 hour).
                            </div>

                            <button class="button -secondary -danger">Delete Client</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
