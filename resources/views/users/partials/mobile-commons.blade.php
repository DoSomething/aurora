<ul class="gallery -duo">
	<li>
		<article class="figure -left">
			@if (!empty($mobile_commons_profile))

				<h3>Account Info</h3>
				<dl class="profile-settings">
					<dt>Mobile Commons Id:</dt><dd>{{{ $mobile_commons_profile['@attributes']['id'] or '' }}}</dd>
					<dt>Status:</dt><dd>{{{ $mobile_commons_profile['status'] or '' }}}</dd>
					{{ isset($mobile_commons_profile['created_at']) ? ('<dt>Signed Up On:</dt><dd>' . e(time_formatter($mobile_commons_profile['created_at']))) : "" }}
					{{ isset($mobile_commons_profile['opted_out_at']) ? ('<dt>Opted Out On:</dt><dd>' . e(time_formatter($mobile_commons_profile['opted_out_at']))) : "" }}
					{{ isset($mobile_commons_profile['opted_out_source']) ? ('<dt>Opted Out Source:</dt><dd>' . e($mobile_commons_profile['opted_out_source'])) : "" }}
					<dt>{{ link_to("https://secure.mcommons.com/profiles/" . e($mobile_commons_profile['@attributes']['id']), "View Mobile Commons Profile") }}</dt>
					<dt><a href="{{{ url('users/' . $northstar_profile['_id'] . '/mobile-commons-messages') }}}">View Message Backlog</a></dt>
				</dl>
			@else
				<h3>This user does not have a mobile commons account</h3>
			@endif
		</article>
	</li>
</ul>
