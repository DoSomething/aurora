<ul class="gallery -duo">
	<li>
		<article class="figure -left">
			<h3>Account Info</h3>
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
</ul>