<ul class="gallery -duo">
	<li>
		<article class="figure -left">
			<dt>Id: {{ $user['_id'] or '' }}</dt>
			<dt>First Name:{{ $user['first_name'] or '' }}</dt>
			<dt>Last Name:{{ $user['last_name'] or '' }}</dt>
			<dt>Email: {{ $user['email'] or '' }}</dt>
			<dt>Mobile: {{ isset($user['mobile']) ? sanitizePhoneNumber($user['mobile']) : ''}}
			</dt>
			<dt>Birthday: {{ $user['birthdate'] or '' }}</dt>
			<dt>Address: {{ $user['addr_street1'] or ''}} {{ $user['addr_street2'] or ''}} {{ $user['add_city'] or ''}}, {{ $user['addr_state'] or ''}} {{ $user['addr_zip'] or ''}}</dt>
			<dt>Country: {{ $user['country'] or '' }}</dt>
		</article>
	</li>

	<!-- not actually displaying campaigns, need to make call to api -->
	<li>
		<article class="figure -left">
			@if (!empty($user['campaigns']))
				@foreach ($user["campaigns"] as $campaign)
					<div class="campaigns">
						<dt>Id: {{ $campaign['_id'] or '' }}</dt>
						<dt>Drupal id: {{ $campaign['drupal_id'] or '' }}</dt>
						<dt>Signup id: {{ $campaign['signup_id'] or '' }}</dt>
						<dt>Signup Source: {{ $campaign['signup_source'] or '' }}</dt>
						<dt>Reportback Id: {{ $campaign['reportback_id'] or '' }}</dt>
					</div>
				@endforeach
			@endif
		</article>
	</li>
</ul>
