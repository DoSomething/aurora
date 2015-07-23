<ul class="gallery -duo">
	<li>
		<article class="figure -left">
			<dl class="profile-settings">
				<dt>Id:</dt><dd>{{{ $northstarProfile['_id'] }}}</dd>
				{{ isset($northstarProfile['drupal_id']) ? ('<dt>Drupal Id:</dt><dd>' . e($northstarProfile['drupal_id']) . '</dd>') : "" }}
				{{ isset($northstarProfile['first_name']) ? ('<dt>First Name:</dt><dd>' . e($northstarProfile['first_name']) . '</dd>') : "" }}
				{{ isset($northstarProfile['last_name']) ? ('<dt>Last Name:</dt><dd>' . e($northstarProfile['last_name']) . '</dd>') : "" }}
				{{ isset($northstarProfile['email']) ? ('<dt>Email:</dt><dd>' . e($northstarProfile['email']) . '</dd>') : "" }}
				{{ isset($northstarProfile['mobile']) ? ('<dt>Mobile:</dt><dd>' . e($northstarProfile['mobile']) . '</dd>') : "" }}
				{{ isset($northstarProfile['birthdate']) ? ('<dt>Birthday:</dt><dd>' . e($northstarProfile['birthdate']) . '</dd>') : "" }}
				@if (isset($northstarProfile['addr_street1']) || isset($northstarProfile['addr_street2']) || isset($northstarProfile['add_city']) || isset($northstarProfile['addr_state']) || isset($northstarProfile['addr_zip']) )
					<dt>Address:</dt><dd>{{{ $northstarProfile['addr_street1'] or '' }}} {{{ $northstarProfile['addr_street2'] or '' }}} {{{ $northstarProfile['add_city'] or '' }}} {{{ $northstarProfile['addr_state'] or '' }}} {{{ $northstarProfile['addr_zip'] or '' }}}</dd>
				@endif
				{{ isset($northstarProfile['country']) ? ('<dt>Country:</dt><dd>' . e($northstarProfile['country']) . '</dd>') : "" }}
			</dl>
		</article>
	</li>
	<li>
		<article class="figure -left">
			<div class="container -padded">
	      @if (!$auroraUser)
	        @include('users.partials.make-admin')
	      @endif
		</article>
	</li>
</ul>
