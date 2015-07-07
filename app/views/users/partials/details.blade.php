<ul class="gallery -duo">
	<li>
		<article class="figure -left">
			<dt>Id: {{ $user['_id'] or '' }}</dt>
			<dt>First Name: {{ $user['first_name'] or '' }}</dt>
			<dt>Last Name: {{ $user['last_name'] or '' }}</dt>
			<dt>Email: {{ $user['email'] or '' }}</dt>
			<dt>Mobile: {{ $user['mobile'] or '' }}</dt>
			<dt>Birthday: {{ $user['birthdate'] or '' }}</dt>
			<dt>Address: {{ $user['addr_street1'] or ''}} {{ $user['addr_street2'] or ''}} {{ $user['add_city'] or ''}}, {{ $user['addr_state'] or ''}} {{ $user['addr_zip'] or ''}}</dt>
			<dt>Country: {{ $user['country'] or '' }}</dt>
		</article>
	</li>

	<!-- not actually displaying campaigns, need to make call to api -->
	<li>
		<article class="figure -left">
			@foreach ($user as $key => $field)
				@if ($key == 'campaigns')
					@foreach($field as $campaigns)
						<div class="campaigns">
							{{var_dump($user["campaigns"])}}
						</div>
					@endforeach
				@endif
			@endforeach
		</article>
	</li>
</ul>
