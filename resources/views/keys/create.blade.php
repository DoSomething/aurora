@extends('layout.master')

@section('main_content')

    @include('layout.header', ['header' => 'API Keys', 'subtitle' => 'Northstar application access & permissions'])

    <div class="container -padded">
        <div class="wrapper">
            <div class="container__block -narrow">
                <h1>Create API Key</h1>

                @include('layout.errors')

                {!! Form::open(['route' => 'keys.store', 'method' => 'post']) !!}
                    <div class="form-item -padded">
                        {!! Form::label('app_id', 'Application ID', ['class' => 'field-label']) !!}
                        {!! Form::text('app_id', null, ['class' => 'text-field']) !!}
                    </div>

                    <div class="form-item -padded">
                        {!! Form::label('api_key', 'API Key', ['class' => 'field-label']) !!}
                        {!! Form::text('api_key', '<randomly generated>', ['class' => 'text-field', 'disabled' => true]) !!}
                    </div>

                    <div class="form-item -padded">
                        {!! Form::label('scope', 'Scope', ['class' => 'field-label']) !!}
                        @foreach($scopes as $scope => $description)
                            <label class="option -checkbox">
                                {!! Form::checkbox('scope['.$scope.']', $scope, false) !!}
                                <span class="option__indicator"></span>
                                <span><strong>{{ $scope }}</strong> – {{ $description }}</span>
                            </label>
                        @endforeach
                    </div>
                    {!! Form::submit('Submit', ['class' => 'button']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop
