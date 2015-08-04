<div class="make-role-header">
	Remove role
</div>
<div class="container__block make-role-container">
	<h4>Remove this user from a role</h4>
	<p>Only give the authority to the right person</p>
	{{ Form::model($northstar_profile, ['route' => array('users.destroy', $northstar_profile['_id']), 'method' => 'delete']) }}
	{{ Form::submit('Remove admin', ['name' => 'type', 'class' => 'button -secondary']) }}
	{{ Form::close() }}
</div>
