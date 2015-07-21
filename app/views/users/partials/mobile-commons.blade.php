<ul class="gallery -duo">
	<li>
		<article class="figure -left">
			@if (!empty($mc_profile))

				<h3>Account Info</h3>
				<dl class="profile-settings">
					<dt>Mobile Commons Id:</dt><dd>{{{ $mc_profile['@attributes']['id'] or '' }}}</dd>
					<dt>Status:</dt><dd>{{{ $mc_profile['status'] or '' }}}</dd>
					{ isset($mc_profile['created_at']) ? ('<dt>Signed Up On:</dt><dd>' . e(time_formatter($mc_profile['created_at']))) : "" }
					{ isset($mc_profile['opted_out_at']) ? ('<dt>Opted Out On:</dt><dd>' . e(time_formatter($mc_profile['opted_out_at']))) : "" }
					{ isset($mc_profile['opted_out_source']) ? ('<dt>Opted Out Source:</dt><dd>' . e($mc_profile['opted_out_source'])) : "" }
					<dt>{{ link_to("https://secure.mcommons.com/profiles/".e($mc_profile['@attributes']['id']), "View Mobile Commons Profile") }}</dt>
					<dt><a href="{{{ url('users/' . $user['_id'] . '/mobile-commons-messages') }}}">View Message Backlog</a></dt>
				</dl>
			@else
				<h3>This user does not have a mobile commons account</h3>
			@endif
		</article>
	</li>
</ul>
