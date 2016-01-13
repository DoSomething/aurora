@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'Zendesk Tickets', 'subtitle' => 'Backlog of all requested tickets'])

<div class ="container -padded">
  <div class="wrapper">
	  <div class="container__block">
	  	@forelse($requested_tickets as $ticket)
	  	<!-- need to add custom css to this -->
	  	<div class="zendesk-ticket {{ ticket_state_class($ticket['status']) }}">
			  	<ul class="gallery -duo">
			  		<li>
				  		<article class="figure -left">
								<div class="container__block">
									<dl class="profile-settings">
							  		{{ isset($ticket['status']) ? ('<dt>Status: </dt><dd>' . ucfirst($ticket['status'])) : "" }}
							  		<dt>Ticket ID: </dt><dd>{{ link_to("https://dosomethingorg1.zendesk.com/agent/tickets/" . $ticket['id'], $ticket['id']) }}</dd>
							  		{{ isset($ticket['orgainzation_id']) ? ('<dt>Organization ID: </dt><dd>' . $ticket['organization_id']) : "" }}
							  		{{ isset($ticket['group_id']) ? ('<dt>Group ID: </dt><dd>' . link_to("https://dosomethingorg1.zendesk.com/groups/" . $ticket['group_id'], $ticket['group_id'])) : "" }}
	  					  		{{ isset($ticket['assignee_id']) ? ('<dt>Assignee ID: </dt><dd>' . link_to("https://dosomethingorg1.zendesk.com/agent/users/" . $ticket['assignee_id'] . "/assigned_tickets", $ticket['assignee_id'])) : "" }}
							  		<dt>Sent On: </dt><dd>{{{ e(time_formatter($ticket['created_at'])) }}}</dd>
							  		@if (!empty($ticket['tags']))
							  		<dt>Tags: </dt>
		  								@foreach ($ticket['tags'] as $tags)
												<dd>
													#{{ $tags }}  &nbsp;
												</dd>
											@endforeach
							  		@endif
							  		{{ isset($ticket['subject']) ? ('<dt>Subject: </dt><dd>' . $ticket['subject']) : "" }}
									</dl>
					  		</div>
				  		</article>
			  		</li>
			  		<li>
			  			<article class="figure -left">
				  			<div class="container__block">
					  			<dl class="profile-settings">
							  		<dt>Content: </dt><dd>{{{ $ticket['description'] }}}</dd>
					  			</dl>
				  			</div>
			  			</article>
			  		</li>
			  	</ul>
	  	</div>
	  	@empty
	  		<h3>This user does not have any tickets</h3>
	  	@endforelse
		</div>
  </div>
</div>

@stop
