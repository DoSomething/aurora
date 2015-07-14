<ul class="gallery -duo">
	<li>
		<article class="figure -left">
			<h3>Account Info</h3>
			<dl class="profile-settings">
				<dt>Id:</dt><dd>{{ $user['_id'] or '' }}</dd>
				{{ isset($user['drupal_id']) ? ('<dt>Drupal Id:</dt><dd>'.$user['drupal_id']) : "" }}
				{{ isset($user['firt_name']) ? ('<dt>First Name:</dt><dd>'.$user['firt_name']) : "" }}
				{{ isset($user['last_name']) ? ('<dt>Last Name:</dt><dd>'.$user['last_name']) : "" }}
				{{ isset($user['email']) ? ('<dt>Email:</dt><dd>'.$user['email']) : "" }}
				{{ isset($user['mobile']) ? ('<dt>Mobile:</dt><dd>'.$user['mobile']) : "" }}
				{{ isset($user['birthdate']) ? ('<dt>Birthday:</dt><dd>'.$user['birthdate']) : "" }}
				{{ isset($user['drupal_id']) ? ('<dt>Address:</dt><dd>'.$user['drupal_id']) : "" }}
				@if (isset($user['addr_street1']) || isset($user['addr_street2']) || isset($user['add_city']) || isset($user['addr_state']) || isset($user['addr_zip']) )
					<dt>Address:</dt><dd>{{ $user['addr_street1'] or ''}} {{ $user['addr_street2'] or ''}} {{ $user['add_city'] or ''}} {{ $user['addr_state'] or ''}} {{ $user['addr_zip'] or ''}}</dd>
				@endif
				{{ isset($user['country']) ? ('<dt>Country:</dt><dd>'.$user['country']) : "" }}
			</dl>
		</article>
	</li>
	<li>
		<article class="figure -left">
			<div class="container -padded">
	      @if (!$aurora_user)
	        @include('users.partials.make-admin')
	      @endif
		</article>
	</li>
</ul>
