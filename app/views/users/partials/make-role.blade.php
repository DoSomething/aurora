<div class="make-role-header">
	Danger Zone
</div>
<div class="container__block make-role-container">
	<h4>Assign this user a role</h4>
	<p>Staff user is able to see all user information</p>
	<p>Admin user is able to see and modify all users information</p>
	@if($role == 'staff')
		{{ Form::open(['route' => array('users.destroy', $northstar_profile['_id']), 'method' => 'delete']) }}
		{{ Form::submit('Remove staff', ['name'=>'type', 'class' => 'button -secondary make-role']) }}
		{{ Form::close() }}
		{{ Form::open(['route' => array('role.create', $northstar_profile['_id'])]) }}
		{{ Form::submit('Make admin', ['name' => 'type', 'value' => '1', 'class' => 'button -secondary mkae-role']) }}
		{{ Form::close() }}
	@else
		{{ Form::open(['route' => array('role.create', $northstar_profile['_id'])]) }}
		{{ Form::submit('Make admin', ['name' => 'type', 'class' => 'button -secondary make-role']) }}
		{{ Form::submit('Make staff', ['name' => 'type', 'class' => 'button -secondary']) }}
		{{ Form::close() }}
	@endif
</div>
