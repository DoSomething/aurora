<script>
 ajax_confirm_and_delete()
</script>
<script>
@forelse($different_tags as $tag)
  $('input[name={{$tag}}]').addClass("has-error");
@empty
@endforelse
</script>
<div class ="container -padded">
  <div class="wrapper">
    <h1 class="heading -hero">Please verify user info</h1>
      @include('users.partials._form')
    </div>
  </div>
</div>
