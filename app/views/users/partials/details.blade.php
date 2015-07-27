<ul class="gallery -duo">
	<li>
		<article class="figure -left">
			<dl class="profile-settings">
				<dt>Id:</dt><dd>{{{ $northstar_profile['_id'] }}}</dd>
				{{ isset($northstar_profile['drupal_id']) ? ('<dt>Drupal Id:</dt><dd>' . e($northstar_profile['drupal_id']) . '</dd>') : "" }}
				{{ isset($northstar_profile['first_name']) ? ('<dt>First Name:</dt><dd>' . e($northstar_profile['first_name']) . '</dd>') : "" }}
				{{ isset($northstar_profile['last_name']) ? ('<dt>Last Name:</dt><dd>' . e($northstar_profile['last_name']) . '</dd>') : "" }}
				{{ isset($northstar_profile['email']) ? ('<dt>Email:</dt><dd>' . e($northstar_profile['email']) . '</dd>') : "" }}
				{{ isset($northstar_profile['mobile']) ? ('<dt>Mobile:</dt><dd>' . e($northstar_profile['mobile']) . '</dd>') : "" }}
				{{ isset($northstar_profile['birthdate']) ? ('<dt>Birthday:</dt><dd>' . e($northstar_profile['birthdate']) . '</dd>') : "" }}
				@if (isset($northstar_profile['addr_street1']) || isset($northstar_profile['addr_street2']) || isset($northstar_profile['add_city']) || isset($northstar_profile['addr_state']) || isset($northstar_profile['addr_zip']) )
					<dt>Address:</dt><dd>{{{ $northstar_profile['addr_street1'] or '' }}} {{{ $northstar_profile['addr_street2'] or '' }}} {{{ $northstar_profile['add_city'] or '' }}} {{{ $northstar_profile['addr_state'] or '' }}} {{{ $northstar_profile['addr_zip'] or '' }}}</dd>
				@endif
				{{ isset($northstar_profile['country']) ? ('<dt>Country:</dt><dd>' . e($northstar_profile['country']) . '</dd>') : "" }}
			</dl>
		</article>
	</li>
	<li>
		<article class="figure -left">
			<div class="container -padded">
	      @if (!$aurora_user or !$aurora_user->hasRole('admin'))
	        @include('users.partials.make-admin')
	      @else
					@include('users.partials.remove-admin')
	      @endif
		</article>
	</li>
</ul>
