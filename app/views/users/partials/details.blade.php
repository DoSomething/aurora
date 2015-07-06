<ul class="gallery -duo">
	<li>
		<article class="figure -left">
				<dt>Id: {{ $user['_id'] }}</dt>
				<dt>First Name:{{ $user['first_name'] }}</dt>
				<dt>Last Name:{{ $user['last_name'] }}</dt>
				<dt>Email: {{ $user['email'] }}</dt>
				<dt>Mobile: {{ $user['mobile'] }}</dt>
				<dt>Birthday: {{ $user['birthdate'] }}</dt>
				<dt>Address: {{ $user['addr_street1']." ". $user['addr_street2']. " ". $user['addr_city'].", ".$user['addr_state']." ".$user['addr_zip']}}</dt>
				<dt>Country: {{ $user['country'] }}</dt>

		</article>
	</li>
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
