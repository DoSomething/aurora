<ul class = "waypoints -primary" id="pagination-buttons">
  @if ($data['current_page'] > 1)
    <?php $prev = $data['current_page'] - 1 ?>
    <li> {{ link_to_route('users.index', 'First', array('page=1')) }} </li>
    <li> {{ link_to_route('users.index', 'Previous', array('page=' . $prev)) }} </li>
  @endif
  <!-- $first_left is the first number being shown on  left pagination from current_page, ex: current page is 8 then first_left is 3 -->
  <?php $first_left = ($data['current_page'] - 5 >= 1) ? $data['current_page'] - 5 : 1 ?>
  <!--  $last_right is the last number being show on the right pagination from current_page, ex: current page is 8 then last_right is 12-->
  <?php $last_right = ($data['current_page'] + 4 <= $data['last_page']) ? $data['current_page'] + 4 : $data['last_page'] ?>
  <!-- this last 2 is just making sure that the pagination always has 10 numbers constantly.  -->
  <!--  Ex. current_page is 26 and last page is 26 then pagination is from 17 to 26 -->
  <?php $last_right = $last_right < 10 && $data['last_page'] > 10 ? 10 : $last_right ?>
  <?php $first_left = $first_left > 10 && $data['last_page'] > 10 ? $last_right - 9 : $first_left ?>
<!-- Iteration through the number and making api calls when page is clicked requesting for user on particular page -->
  @foreach(range($first_left, $last_right) as $page)
    @if($data['current_page'] == $page)
      <li class="is-active">{{ $data['current_page'] }}</li>
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
