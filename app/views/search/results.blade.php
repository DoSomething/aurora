@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'Search Results', 'subtitle' => ''])

<div class="container -padded">
	<div class="wrapper">
		<div class="container__block">
			{{ Form::open(['route' => 'users.merge', "method" => "post"]) }}
				<ul class="gallery -duo">
				@forelse($northstar_users as $northstar_profile)
					<li>
						<article class="figure -left">
							<dl class="profile-settings">
							  <dt><a href="{{ url('users/' . $northstar_profile['_id'] . '/edit') }}">Edit User</a></dt>
								<dt>Id:</dt><dd>{{ link_to_route('users.show', $northstar_profile['_id'], array($northstar_profile['_id'])) }}</dd>
								{{ isset($northstar_profile['updated_at']) ? ('<dt>Updated At:</dt><dd>' . e(time_formatter($northstar_profile['updated_at'])) . '</dd>') : "" }}
								{{ isset($northstar_profile['drupal_id']) ? ('<dt>Drupal Id:</dt><dd>' . e($northstar_profile['drupal_id']) . '</dd>') : "" }}
								{{ isset($northstar_profile['first_name']) ? ('<dt>First Name:</dt><dd>' . e($northstar_profile['first_name']) . '</dd>') : "" }}
								{{ isset($northstar_profile['last_name']) ? ('<dt>Last Name:</dt><dd>' . e($northstar_profile['last_name']) . '</dd>') : "" }}
								{{ isset($northstar_profile['email']) ? ('<dt>Email:</dt><dd>' . e($northstar_profile['email']) . '</dd>') : "" }}
								{{ isset($northstar_profile['mobile']) ? ('<dt>Mobile:</dt><dd>' . e($northstar_profile['mobile']) . '</dd>') : "" }}
								{{ isset($northstar_profile['birthdate']) ? ('<dt>Birthday:</dt><dd>' . e($northstar_profile['birthdate']) . '</dd>') : "" }}
								@if (isset($northstar_profile['addr_street1']) || isset($northstar_profile['addr_street2']) || isset($northstar_profile['addr_city']) || isset($northstar_profile['addr_state']) || isset($northstar_profile['addr_zip']) )
									<dt>Address:</dt><dd>{{{ $northstar_profile['addr_street1'] or '' }}} {{{ $northstar_profile['addr_street2'] or '' }}} {{{ $northstar_profile['add_city'] or '' }}} {{{ $northstar_profile['addr_state'] or '' }}} {{{ $northstar_profile['addr_zip'] or '' }}}</dd>
								@endif
								{{ isset($northstar_profile['country']) ? ('<dt>Country:</dt><dd>' . e($northstar_profile['country']) . '</dd>') : "" }}
								{{ isset($northstar_profile['campaigns']) ? ('<dt>No. of Campaigns:</dt><dd>' . count($northstar_profile['campaigns']) . '</dd>') : "<dt>This user has no campaigns</dt>" }}
								<dt>{{ Form::radio('keep', $northstar_profile['_id'], false, ['class' => 'merge']) }}</dt><dd>{{ Form::label('Keep this user')}}</dd>
							</dl>
						</article>
					</li>
				@empty
					No User Found
				@endforelse
			</ul>
			{{ Form::submit('Merge Users', ['class' => 'button -secondary']) }}
      {{ Form::close() }}
		</div>
	</div>
</div>
<div class="container -padded">
	<div class="wrapper">
		<div class="container__block">
			<div id="merge-form">
				
			</div>
			
		</div>
	</div>
</div>
{{ addClassToFirstResult() }}
<!-- {{ userDeleteConfirmation() }} -->
<script>
	$(document).ready(function(){
		$('.merge').click(function(){
			var keep = $(this).val();
			var delete_ids = [];
			$("[type=radio]").each(function(index, radio){
				if(radio.checked != true){
					delete_ids.push(radio.value);
				}
			});
			$.ajax({
				url: '/merge',
				method: 'GET',
				data: {
					keep: keep,
					delete: delete_ids
				}
			}).done(function(view){
				debugger
				$('#merge-form').html(view);
			});
		});
	});
</script>
@stop



