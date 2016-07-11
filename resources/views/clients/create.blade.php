@extends('layout.master')

@section('main_content')

    @include('layout.header', ['header' => 'API Keys', 'subtitle' => 'Northstar application access & permissions'])

    <div class="container -padded">
        <div class="wrapper">
            <div class="container__block -narrow">
                <h1>Create Clients</h1>

                @include('layout.errors')

                {!! Form::open(['route' => 'clients.store', 'method' => 'post']) !!}
                    <div class="form-item -padded">
                        {!! Form::label('client_id', 'Client ID', ['class' => 'field-label']) !!}
                        {!! Form::text('client_id', null, ['class' => 'text-field']) !!}
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
