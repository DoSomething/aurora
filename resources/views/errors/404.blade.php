@extends('layout.master')

@section('main_content')

    @include('layout.header', ["header" => "Not Found", "subtitle" => "We couldn't find that thing."])

    <div class="container -padded">
        <div class="wrapper">
            <div class="container__block -narrow">
                <h1>Hmmm, what happened?</h1>
                <p>If you followed a link from within Aurora, please
                    <a href="https://github.com/DoSomething/aurora/issues/new">report an issue</a> and we'll try to
                    figure out what might have went wrong. If you followed a link from elsewhere, perhaps the thing
                    you were looking for has been deleted?</p>
                <p>Well, either way&hellip; it's not here.</p>
            </div>

            <div class="container__block -narrow">
                <h3>Perhaps a search will help?</h3>
                @include('search.search')
            </div>
        </div>
    </div>
@stop
