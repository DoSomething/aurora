
<div class="subscription-header">
	Subscriptions
</div>
<div class="container__block subscription-container">
	<!-- Unsubscribe User from Mobile Commons -->
	@if(!empty($mobile_commons_profile))
		@if($mobile_commons_profile['status'] === "Active Subscriber")
			{{ Form::open(['route' => array('users.unsubscribe-mobilecommons', $northstar_profile['_id']), 'method' => 'delete']) }}
			{{ Form::label('', "MobileCommons", ['class' => 'field-label']) }}
			{{ Form::submit('Unsubscribe', ['name' => 'type', 'class' => 'button -secondary']) }}
			{{ Form::close() }}
		@else
			<h4>This user does not have a MobileCommons subscription</h4>
		@endif
	@endif

	<!-- Unsubscribe User to MailChimp -->
	@if (!empty($mailchimp_list_id))
		{{ Form::open(['route' => array('users.unsubscribe-mailchimp', $northstar_profile['_id'], 'mailchimp_list_id' => $mailchimp_list_id), 'method' => 'delete']) }}
		{{ Form::label('', "MailChimp", ['class' => 'field-label']) }}
		{{ Form::submit('Unsubscribe', ['name' => 'type', 'class' => 'button -secondary']) }}
		{{ Form::close() }}
	@else
		<h4>This user does not have a mailchimp subscription</h4>
	@endif
</div>
