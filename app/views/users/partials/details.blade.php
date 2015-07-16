<ul class="gallery -duo">
	<li>
		<article class="figure -left">
			<h3>Account Info</h3>
			<dl class="profile-settings">
				<dt>Id:</dt><dd>{{{ $user['_id'] }}}</dd>
				{{ isset($user['drupal_id']) ? ('<dt>Drupal Id:</dt><dd>' . e($user['drupal_id']) . '</dd>') : "" }}
				{{ isset($user['first_name']) ? ('<dt>First Name:</dt><dd>' . e($user['first_name']) . '</dd>') : "" }}
				{{ isset($user['last_name']) ? ('<dt>Last Name:</dt><dd>' . e($user['last_name']) . '</dd>') : "" }}
				{{ isset($user['email']) ? ('<dt>Email:</dt><dd>' . e($user['email']) . '</dd>') : "" }}
				{{ isset($user['mobile']) ? ('<dt>Mobile:</dt><dd>' . e($user['mobile']) . '</dd>') : "" }}
				{{ isset($user['birthdate']) ? ('<dt>Birthday:</dt><dd>' . e($user['birthdate']) . '</dd>') : "" }}
				@if (isset($user['addr_street1']) || isset($user['addr_street2']) || isset($user['add_city']) || isset($user['addr_state']) || isset($user['addr_zip']) )
					<dt>Address:</dt><dd>{{{ $user['addr_street1'] or '' }}} {{{ $user['addr_street2'] or '' }}} {{{ $user['add_city'] or '' }}} {{{ $user['addr_state'] or '' }}} {{{ $user['addr_zip'] or '' }}}</dd>
				@endif
				{{ isset($user['country']) ? ('<dt>Country:</dt><dd>' . e($user['country']) . '</dd>') : "" }}
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
