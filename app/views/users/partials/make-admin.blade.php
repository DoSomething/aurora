<div class="make-admin-header">
	Danger Zone
</div>
<div class="container__block make-admin-container">
	<h4>Assign this user a role</h4>
	<p>Staff user is able to see all user information</p>
	<p>Admin user is able to see and modify all users information</p>
	{{ Form::open(['route' => array('admin.create', $northstar_profile['_id'])]) }}
	{{ Form::submit('Make staff', ['name' => 'type', 'value' => '2', 'class' => 'button -secondary']) }}
	{{ Form::submit('Make admin', ['name' => 'type', 'value' => '1', 'class' => 'button -secondary']) }}
	{{ Form::close() }}
</div>
