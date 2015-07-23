<ul class="gallery -duo">
	<li>
		<article class="figure -left">
			@if (!empty($mobileCommonsProfile))

				<h3>Account Info</h3>
				<dl class="profile-settings">
					<dt>Mobile Commons Id:</dt><dd>{{{ $mobileCommonsProfile['@attributes']['id'] or '' }}}</dd>
					<dt>Status:</dt><dd>{{{ $mobileCommonsProfile['status'] or '' }}}</dd>
					{{ isset($mobileCommonsProfile['created_at']) ? ('<dt>Signed Up On:</dt><dd>' . e(time_formatter($mobileCommonsProfile['created_at']))) : "" }}
					{{ isset($mobileCommonsProfile['opted_out_at']) ? ('<dt>Opted Out On:</dt><dd>' . e(time_formatter($mobileCommonsProfile['opted_out_at']))) : "" }}
					{{ isset($mobileCommonsProfile['opted_out_source']) ? ('<dt>Opted Out Source:</dt><dd>' . e($mobileCommonsProfile['opted_out_source'])) : "" }}
					<dt>{{ link_to("https://secure.mcommons.com/profiles/" . e($mobileCommonsProfile['@attributes']['id']), "View Mobile Commons Profile") }}</dt>
					<dt><a href="{{{ url('users/' . $northstarProfile['_id'] . '/mobile-commons-messages') }}}">View Message Backlog</a></dt>
				</dl>
			@else
				<h3>This user does not have a mobile commons account</h3>
			@endif
		</article>
	</li>
</ul>
