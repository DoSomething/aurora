<ul class = "waypoints pagination-buttons" style="float: right">
 <li> {{ link_to_route('users.index', 'First', array('page=1')) }} </li>

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
