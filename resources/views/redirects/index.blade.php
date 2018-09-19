@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'Redirects', 'subtitle' => 'Create & manage URL redirects.'])

<div class="container -padded">
  <div class="wrapper">
      <div class="container__block -narrow">
          <div class="gallery__heading"><h1>All Redirects</h1></div>
          <p>These are the URL redirects registered in Fastly.</p>
      </div>
      <ul class="gallery -duo">
      <div class="container__block">
          <table class="table">
              <thead>
                  <tr class="row table-header">
                      <th class="table-cell">Path</th>
                      <th class="table-cell">Target</th>
                      <th class="table-cell">Status</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($redirects as $redirect)
                      <tr class="table-row">
                          <td class="table-cell break-all"><a href="{{
                          route('redirects.show', [$redirect->id]) }}">{{ str_limit($redirect->path, 50) }}</a></td>
                          <td class="table-cell break-all">{{ str_limit($redirect->target, 30) }}</td>
                          <td class="table-cell"><code>{{ $redirect->status }}</code></td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
      <div class="container__block">
          <a class="button -secondary" href="{{ route('redirects.create') }}">New redirect</a>
      </div>

	</div>
</div>
@stop
