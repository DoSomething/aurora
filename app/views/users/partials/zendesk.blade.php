<ul class="gallery -duo">
	@if (!empty($zendesk_profile))
		<li>
			<article class="figure -left">
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
						<dt>{{ link_to("https://dosomethingorg1.zendesk.com/agent/users/" . e($zendesk_profile['id']) . "/requested_tickets", "View Zendesk Profile") }}</dt>
						<dt><a href="{{{ url('users/' . $northstar_profile['_id'] . '/zendesk-tickets') }}}">View Zendesk Tickets</a></dt>
					</dl>
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
	@else
		<h3>This user has no Zendesk activity</h3>
	@endif
</ul>




