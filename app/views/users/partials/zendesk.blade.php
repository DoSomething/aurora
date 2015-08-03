<ul class="gallery -duo">
	<li>
		<article class="figure -left">
			@if (!empty($zendesk_profile))
				<h3>Account Info</h3>
				<dl class="profile-settings">
					<dt>Zendesk Id: </dt><dd>{{{ $zendesk_profile['id'] or '' }}}</dd>
					{{ isset($zendesk_profile['organization_id']) ? ('<dt>Organization Id: </dt><dd>' . $zendesk_profile['organization_id']) : "" }}
					<dt>Tags: </dt>
						@foreach ($zendesk_profile['tags'] as $tags)
							<dd>
								#{{ $tags }}  &nbsp;
							</dd>
						@endforeach
					{{ isset($zendesk_profile['notes']) ? ('<dt>Notes: </dt><dd>' . $zendesk_profile['notes']) : "" }}
					<dt>{{ link_to("https://dosomethingorg1.zendesk.com/agent/users/" . e($zendesk_profile['id']) . "requested_tickets", "View Zendesk Profile") }}</dt>
				</dl>
			@else
				<h3>This user does not have any Zendesk activity</h3>
			@endif
		</article>
	</li>
	<li>
		<h3>User Fields</h3>
		<article class="figure -left">
			<dl class="profile-settings">
				@foreach($zendesk_profile['user_fields'] as $key => $field)
		      @if (!empty($field))
	        	<dt>{{ ucfirst($key) }}: </dt>
	        	<dd> {{ $field }} </dd>
		      @endif
		  	@endforeach				
			</dl>
		</article>
	</li>
</ul>




