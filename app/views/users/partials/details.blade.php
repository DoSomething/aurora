<ul class="gallery -duo">
	<li>
		<article class="figure -left">
			<dl class="profile-settings">
				<dt>Id:</dt><dd>{{ $user['_id'] or '' }}</dd>
				<dt>First Name:</dt><dd>{{ $user['first_name'] or '' }}</dd>
				<dt>Last Name:</dt><dd>{{ $user['last_name'] or '' }}</dd>
				<dt>Email:</dt><dd>{{ $user['email'] or '' }}</dd>
				<dt>Mobile:</dt><dd>{{ $user['mobile'] or '' }}</dd>
				<dt>Birthday:</dt><dd>{{ $user['birthdate'] or '' }}</dd>
				<dt>Address:</dt><dd>{{ $user['addr_street1'] or ''}} {{ $user['addr_street2'] or ''}} {{ $user['add_city'] or ''}}, {{ $user['addr_state'] or ''}} {{ $user['addr_zip'] or ''}}</dd>
				<dt>Country:</dt><dd>{{ $user['country'] or '' }}</dd>
			</dl>
		</article>
	</li>

	<!-- not actually displaying campaigns, need to make call to api -->
	<li>
	  <article class="figure -left">
	    @if (!empty($user['campaigns']))
	      @foreach ($user["campaigns"] as $campaign)
      		<dl class="profile-settings">
          	<!-- This Id is a problem, where dummy data has different nested array from actual drupal callback data -->
          	<!-- Not quite sure what Id is as well -->
	          <dt>Id:</dt><dd>{{ $campaign['_id']['$id'] or '' }}</dd>
	          <dt>Drupal id:</dt><dd>{{ $campaign['drupal_id'] or '' }}</dd>
	          <dt>Signup id:</dt><dd>{{ $campaign['signup_id'] or '' }}</dd>
	          <dt>Signup Source:</dt> <dd>{{ $campaign['signup_source'] or '' }}</dd>
	          <dt>Reportback Id:</dt><dd>{{ $campaign['reportback_id'] or '' }}</dd>
      		</dl>
      	@endforeach
    	@endif
  	</article>
	</li>
</ul>
