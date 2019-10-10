@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'Redirects', 'subtitle' => 'Create & manage URL redirects.'])

    <div class="container -padded">
        <div class="wrapper">
            <div class="container__block -narrow">
                <h1><code>{{ $redirect->path }}</code></h1>

                @include('layout.errors')

                <form action="{{ route('redirects.update', $redirect->id) }}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-item -padded">
                        {!! Form::label('path', 'Incoming Path', ['class' => 'field-label']) !!}
                        {!! Form::text('path', $redirect->path, ['class' => 'text-field', 'disabled' => true]) !!}
                    </div>

                    <div class="form-item -padded">
                        {!! Form::label('target', 'Target URL', ['class' => 'field-label']) !!}
                        {!! Form::text('target', $redirect->target, ['class' => 'text-field',
                        'placeholder' => 'e.g. https://www.dosomething.org/new-path']) !!}
                    </div>

                    {!! Form::submit('Submit', ['class' => 'button']) !!}
                </form>

            </div>
    </div>

@stop
