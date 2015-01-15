@extends('layout.master')

@section('main_content')

@include('users.partials.search')

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
    <tr>
    <!--@TODO: input real user content. -->
      <td>1</td>
      <td>Mark</td>
      <td>Otto</td>
      <td>gmail@mdo</td>
      <td>55555555</td>
    </tr>
    <tr>
      <td>2</td>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>gmail@fat</td>
      <td>4444444</td>
    </tr>
  </tbody>
</table>

@stop
