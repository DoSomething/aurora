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

                    <div class="form-item -padded">
                        {!! Form::label('status', 'Redirect Type', ['class' => 'field-label']) !!}
                        <div class="select">
                            {!! Form::select('status', ['301' => '301 (Moved Permanently)', '302' => '302 (Found)'], $redirect->status) !!}
                        </div>
                        <em class="footnote">With <strong>301 Moved Permanently</strong>,
                            Google will update their records with this new URL. Use
                            <strong>302 Found</strong> if the redirect is temporary.</em>
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
                            <label for="role" class="field-label">Delete Redirect</label>
                            <p class="footnote">This will
                                <strong>delete</strong> this redirect and it
                                will no longer be available to users or search
                                engines.
                        </div>

                        <a class="button -secondary -danger"
                            href="{{ route('redirects.destroy', $redirect->id) }}"
                            data-method="DELETE" data-confirm="Are you sure you want to delete this redirect?">Delete Client</a>
                    </div>
                </div>
            </div>
    </div>

@stop
