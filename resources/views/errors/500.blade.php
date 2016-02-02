@extends('layout.master')

@section('main_content')

    @include('layout.header', ["header" => "Boom!", "subtitle" => "We couldn't finish this request."])

    <div class="container -padded">
        <div class="wrapper">
            <div class="container__block -narrow">
                <h1>Drat, something went wrong.</h1>
                <p>Something went wrong with this request, and Aurora wasn't able to fix it. Please
                    <a href="https://github.com/DoSomething/aurora/issues/new">report an issue</a> with the details listed below
                    and we'll try to figure out what might have went wrong.</p>
            </div>

            <div class="container__block -narrow">
                <div class="footnote">
                    <h4>Technical Details</h4>
                    [{{ $exception->getStatusCode() }}] {{ $exception->getMessage() }}<br/>
                    {{ request()->url() }}
                </div>
            </div>
        </div>
    </div>
@stop
