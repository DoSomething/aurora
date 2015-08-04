<!-- Assign Role -->
@if(!in_array("admin", $user_roles))
	<div class="assign-role-header">
		Assign Role
	</div>
	<div class="container__block assign-role-container">
		<div class="select">
			{{ Form::open(['route' => array('role.create', $northstar_profile['_id'])]) }}
				{{ Form::select('role', $roles) }}
				{{ Form::submit('Submit', ['name' => 'type', 'class' => 'button -secondary']) }}
			{{ Form::close() }}
		</div>
	</div>
@endif


<!-- Remove Role -->
<div class="form-item -padded">
	{{ Form::model($northstar_profile, ['route' => array('users.destroy', $northstar_profile['_id']), 'method' => 'delete']) }}
	{{ Form::hidden('role', $aurora_user->findRole()) }}
	{{ Form::submit('Remove role as '. $aurora_user->findRole(), ['name' => 'type', 'class' => 'button -secondary']) }}
	{{ Form::close() }}
</div>
