@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'Redirects', 'subtitle' => 'Create & manage URL redirects.'])

    <div class="container -padded">
        <div class="wrapper">
            <div class="container__block -narrow">
                <h1>Create Redirect</h1>

                @include('layout.errors')

                {!! Form::open(['route' => 'redirects.store', 'method' => 'post']) !!}
                    <div class="form-item -padded">
                        {!! Form::label('path', 'Incoming Path', ['class' => 'field-label']) !!}
                        {!! Form::text('path', null, ['class' => 'text-field',
                        'placeholder' => 'e.g. /us/campaigns/old-path']) !!}
                    </div>

                    <div class="form-item -padded">
                        {!! Form::label('target', 'Target URL', ['class' => 'field-label']) !!}
                        {!! Form::text('target', null, ['class' => 'text-field',
                        'placeholder' => 'e.g. https://www.dosomething.org/new-path']) !!}
                    </div>

                    {!! Form::submit('Submit', ['class' => 'button']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop
