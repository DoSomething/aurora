{{ Form::model($northstar_profile, ['method' => 'DELETE', 'route' => ['users.delete', $northstar_profile['_id']]]) }}
{{ Form::submit('Delete user', ['class' => 'button -secondary delete-warning']) }}
{{ Form::close() }}