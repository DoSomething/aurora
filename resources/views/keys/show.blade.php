@extends('layout.master')

@section('main_content')

    @include('layout.header', ['header' => 'API Keys', 'subtitle' => 'Northstar application access & permissions'])

    <div class="container -padded">
        <div class="wrapper">
            <div class="container__block">
                <h1>{{ $key->app_id }}</h1>
            </div>

            <div class="container__block">
                <h4>Credentials:</h4>
                <pre>X-DS-REST-API-Key: {{ $key->api_key }}</pre>
                <p class="footnote">Send this header with any requests to use this API key.</p>
            </div>

            <div class="container__block">
                <h4>Scopes</h4>
                <ul class="list -compacted">
                    @foreach($key->scope as $scope)
                        <li>{{ $scope }}</li>
                    @endforeach
                </ul>


            </div>
            <div class="container__block">
                <ul class="form-actions -inline">
                    <li><a class="button -secondary" href="{{ route('keys.edit', [ $key->api_key]) }}">Edit Key</a></li>
                    <li>
                        <form action="{{ route('keys.destroy', $key->api_key) }}" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="button -secondary -danger">Delete Key</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@stop
