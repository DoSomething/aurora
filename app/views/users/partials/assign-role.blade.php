<!-- Assign role -->
@if(!in_array("admin", $user_roles))
	<div class="assign-role-header">
		Assign Role
	</div>
	<div class="container__block assign-role-container">
		<div class="select">
			{{ Form::open(['route' => array('role.create', $northstar_profile['_id'])]) }}
				{{ Form::select('role', $unassigned_roles) }}
				{{ Form::submit('Submit', ['name' => 'type', 'class' => 'button -secondary']) }}
			{{ Form::close() }}
		</div>
	</div>
@endif

<!-- Remove role in hierarchy -->
@if(!empty($user_roles))
	<div class="form-item -padded">
		{{ Form::model($northstar_profile, ['route' => array('users.destroy', $northstar_profile['_id']), 'method' => 'delete']) }}
		{{ Form::hidden('role', value(array_slice($user_roles, -1, 1)[0]) ) }}
		{{ Form::submit('Remove role as '. value(array_slice($user_roles, -1, 1)[0]), ['name' => 'type', 'class' => 'button -secondary']) }}
		{{ Form::close() }}
	</div>
@endif
