@extends('layout.master')

@section('main_content')

@include('users.partials.search')

<table class= "table table-striped table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Drupal id</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <!--@TODO: input real user content. -->
      <td>1</td>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <td>2</td>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
  </tbody>
</table>

@stop
