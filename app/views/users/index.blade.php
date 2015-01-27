@extends('layout.master')

@section('main_content')

@include('users.partials.search')

@if ($users)
  <table class= "table table-striped table-bordered">
    <thead>
      <tr>
        <th>_id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users['data'] as $user)
        <tr>
          <td> {{ link_to_route('users.show', $user['_id'], array($user['_id'])) }}</td>
          <td> {{ $user['first_name'] or '' }}</td>
          <td> {{ $user['last_name'] or '' }}</td>
          <td> {{ $user['email']  or '' }}</td>
          <td> {{ $user['mobile'] or '' }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endif

@stop
