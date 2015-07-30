<div class ="container -padded">
  <div class="wrapper">
    <h1 class="heading -hero">Please verify user info</h1>
      @include('users.partials._form')
    </div>
  </div>
</div>

<script>	
	confirm_submit("CAUTION! This will delete other users that were not specified. Are you sure you want to proceed?", ajax_delete_unmerged_users);
</script>
