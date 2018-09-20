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

                    <div class="form-item -padded">
                        {!! Form::label('status', 'Redirect Type', ['class' => 'field-label']) !!}
                        <div class="select">
                            {!! Form::select('status', ['301' => '301 (Moved Permanently)', '302' => '302 (Found)']) !!}
                        </div>
                        <em class="footnote">With <strong>301 Moved Permanently</strong>,
                            Google will update their records with this new URL. Use
                            <strong>302 Found</strong> if the redirect is temporary.</em>
                    </div>

                    {!! Form::submit('Submit', ['class' => 'button']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop
