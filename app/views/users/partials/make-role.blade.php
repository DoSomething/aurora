<div class="assign-role-header">
	Assign Role
</div>
<div class="container__block assign-role-container">
	<h4>Assign this user a role</h4>
	<p>Staff user is able to see all user information</p>
	<p>Admin user is able to see and modify all users information</p>
	@if($role == 'staff')
	<div class="assign-role-form">
		{{ Form::open(['route' => array('users.destroy', $northstar_profile['_id']), 'method' => 'delete']) }}
		{{ Form::submit('Remove staff', ['name'=>'type', 'class' => 'button -secondary -role']) }}
		{{ Form::close() }}
	</div>
	<div class="assign-role-form">
		{{ Form::open(['route' => array('role.create', $northstar_profile['_id'])]) }}
		{{ Form::submit('Admin', ['name' => 'type', 'value' => '1', 'class' => 'button -secondary']) }}
		{{ Form::close() }}
	</div>
	@else
		{{ Form::open(['route' => array('role.create', $northstar_profile['_id'])]) }}
		{{ Form::submit('Admin', ['name' => 'type', 'class' => 'button -secondary']) }}
		{{ Form::submit('Staff', ['name' => 'type', 'class' => 'button -secondary']) }}
		{{ Form::close() }}
	@endif
</div>

{{ Form::open(['route' => array('role.create', $northstar_profile['_id'])]) }}
	{{ Form::select('role', array('1' => 'Admin', '2' => 'Staff', '3' => 'Intern')) }}
	{{ Form::submit('Submit\', ['name' => 'type', 'class' => 'button -secondary']) }}
{{ Form::close() }}
