@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'Redirects', 'subtitle' => 'Create & manage URL redirects.'])

    <div class="container -padded">
        <div class="wrapper">
            <div class="container__block -narrow">
                <h1><code>{{ $redirect->path }}</code></h1>
            </div>

            <div class="container__block -narrow">
                <label class="field-label">Path:</label>
                <code><em>{{ config('services.fastly.service_url') }}</em>{{ $redirect->path }}</code><br><br>
                <label class="field-label">Target:</label>
                <code>{{ $redirect->target }}</code><br><br>
                <label class="field-label">Redirect Status:</label>
                <code>{{ $redirect->status }}</code><br><br>
            </div>

            <div class="container__block -narrow">
                <a class="secondary" href="{{ route('redirects.edit', [ $redirect->id ]) }}">Edit this redirect</a>
                <p class="footnote">
                    Last updated: {{ $redirect->updated_at->format('F d, Y g:ia') }}<br />
                    Created: {{ $redirect->created_at->format('F d, Y g:ia') }}
                </p>
            </div>
        </div>
    </div>
@stop
