@extends('layout.master')

@section('main_content')

@include('users.partials.search')

<ul class = "pagination">
  <li> {{ link_to_route('users.index', 'First', array('page=1')) }} </li>

  @if ($users['current_page'] > 1)
    <?php $prev =  $users['current_page'] - 1 ?>
    <li> {{ link_to_route('users.index', 'Prev', array('page=' . $prev))}} </li>
  @endif

  @if ($users['current_page'] < $users['last_page'])
    <?php $next =  $users['current_page'] + 1 ?>
    <li> {{ link_to_route('users.index', 'Next', array('page=' . $next))}} </li>
  @endif

  <li> {{ link_to_route('users.index', 'Last', array('page='. $users['last_page'])) }} </li>
</ul>

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
