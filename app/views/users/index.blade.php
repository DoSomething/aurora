@extends('layout.master')

@section('main_content')

@include('users.partials.search')

@if ($users)
   <p class="pagination-buttons"> Total members : {{ $users['total'] }}</p>
    @include('users.partials.waypoints')
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
