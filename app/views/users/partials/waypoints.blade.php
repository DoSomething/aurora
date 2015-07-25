<ul class = "waypoints pagination-buttons" id="pagination-box">
  @if ($data['current_page'] > 1)
    <?php $prev = $data['current_page'] - 1 ?>
    <li> {{ link_to_route('users.index', 'First', array('page=1')) }} </li>
    <li> {{ link_to_route('users.index', 'Previous', array('page=' . $prev)) }} </li>
  @endif

  <?php $lastLeft = ($data['current_page'] - 5 >= 1) ? $data['current_page'] - 5 : 1 ?>
  <?php $lastRight = ($data['current_page'] + 4 <= $data['last_page']) ? $data['current_page'] + 4 : $data['last_page'] ?>
  <?php $lastRight = $lastRight < 10 && $data['last_page'] > 10 ? 10 : $lastRight ?>
  <?php $lastLeft = $lastLeft > 10 && $data['last_page'] > 10 ? $lastRight-9 : $lastLeft ?>

  @foreach(range($lastLeft, $lastRight) as $page)
    @if($data['current_page'] == $page)
      <li>{{ $data['current_page'] }}</li>
    @else
      <li>{{ link_to_route('users.index', $page , array('page='. $page)) }}</li>
    @endif
  @endforeach

  @if ($data['current_page'] < $data['last_page'])
    <?php $next =  $data['current_page'] + 1 ?>
    <li> {{ link_to_route('users.index', 'Next', array('page=' . $next)) }} </li>
    <li> {{ link_to_route('users.index', 'Last', array('page='. $data['last_page'])) }} </li>
  @endif

</ul>
