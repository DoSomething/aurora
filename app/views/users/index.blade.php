@extends('layout.master')

@section('main_content')

@include('users.partials.search')

<ul class = "waypoints">
 <li class="is-active"> {{ link_to_route('users.index', 'First', array('page=1')) }} </li>

 @if ($users['current_page'] > 1)
   <?php $prev =  $users['current_page'] - 1 ?>
   <li> {{ link_to_route('users.index', 'Prev', array('page=' . $prev))}} </li>
 @endif

 @if ($users['current_page'] < $users['last_page'])
   <?php $next =  $users['current_page'] + 1 ?>
   <li class="waypoints__primary-link"> {{ link_to_route('users.index', 'Next', array('page=' . $next))}} </li>
 @endif

 <li> {{ link_to_route('users.index', 'Last', array('page='. $users['last_page'])) }} </li>
</ul>

@if ($users)
 <h4> Total members : {{ $users['total'] }}</h4>
   <table id="user-table">
     <thead>
       <tr class="row table-header">
         <th class="table-cell">_id</th>
         <th class="table-cell">First Name</th>
         <th class="table-cell">Last Name</th>
         <th class="table-cell">Email</th>
         <th class="table-cell">Phone</th>
       </tr>
     </thead>
     <tbody>
       @foreach($users['data'] as $user)
         <tr class="table-row">
           <td class="table-cell"> {{ link_to_route('users.show', $user['_id'], array($user['_id'])) }}</td>
           <td class="table-cell"> {{ $user['first_name'] or '' }}</td>
           <td class="table-cell"> {{ $user['last_name'] or '' }}</td>
           <td class="table-cell"> {{ $user['email']  or '' }}</td>
           <td class="table-cell"> {{ $user['mobile'] or '' }}</td>
         </tr>
       @endforeach
     </tbody>
   </table>
@endif

@stop
