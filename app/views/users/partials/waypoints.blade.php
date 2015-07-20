<ul class = "waypoints pagination-buttons" style="float: right">
 <li> {{ link_to_route('users.index', 'First', array('page=1')) }} </li>

 @if ($data['current_page'] > 1)
   <?php $prev =  $data['current_page'] - 1 ?>
   <li> {{ link_to_route('users.index', 'Prev', array('page=' . $prev))}} </li>
 @endif

 @if ($data['current_page'] < $data['last_page'])
   <?php $next =  $data['current_page'] + 1 ?>
   <li class="waypoints__primary-link"> {{ link_to_route('users.index', 'Next', array('page=' . $next))}} </li>
 @endif

 <li> {{ link_to_route('users.index', 'Last', array('page='. $data['last_page'])) }} </li>
</ul>
