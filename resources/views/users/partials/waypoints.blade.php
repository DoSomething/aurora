<ul class = "waypoints -primary" id="pagination-buttons">
  @if ($data['meta']['pagination']['current_page'] > 1)
    <?php $prev = $data['meta']['pagination']['current_page'] - 1 ?>
    <li><a href="{{ route('users.index', [$inputs . '&page=1']) }}">First</a> </li>
    <li><a href="{{ route('users.index', [$inputs . '&page=' . $prev]) }}">Previous</a> </li>
  @endif
  <!-- $first_left is the first number being shown on  left pagination from current_page, ex: current page is 8 then first_left is 3 -->
  <?php $first_left = ($data['meta']['pagination']['current_page'] - 5 >= 1) ? $data['current_page'] - 5 : 1 ?>
  <!--  $last_right is the last number being show on the right pagination from current_page, ex: current page is 8 then last_right is 12-->
  <?php $last_right = ($data['meta']['pagination']['current_page'] + 4 <= $data['meta']['pagination']['total_pages']) ? $data['meta']['pagination']['current_page'] + 4 : $data['meta']['pagination']['total_pages'] ?>
  <!-- this last 2 is just making sure that the pagination always has 10 numbers constantly.  -->
  <!--  Ex. current_page is 26 and last page is 26 then pagination is from 17 to 26 -->
  <?php $last_right = $last_right < 10 && $data['meta']['pagination']['total_pages'] > 10 ? 10 : $last_right ?>
  <?php $first_left = $first_left > 10 && $data['meta']['pagination']['total_pages'] > 10 ? $last_right - 9 : $first_left ?>
<!-- Iteration through the number and making api calls when page is clicked requesting for user on particular page -->
  @foreach(range($first_left, $last_right) as $page)
    @if($data['meta']['pagination']['current_page'] == $page)
      <li class="is-active">{{ $data['meta']['pagination']['current_page'] }}</li>
    @else
      <li><a href="{{ route('users.index', [$inputs . '&page='. $page]) }}">{{ $page }}</a></li>
    @endif
  @endforeach

  @if ($data['meta']['pagination']['current_page'] < $data['meta']['pagination']['total_pages'])
    <?php $next =  $data['meta']['pagination']['current_page'] + 1 ?>
    <li><a href="{{ route('users.index', [$inputs . '&page=' . $next]) }}">Next</a> </li>
    <li><a href="{{ route('users.index', [$inputs . '&page='. $data['meta']['pagination']['total_pages']]) }}">Last</a> </li>
  @endif
</ul>
