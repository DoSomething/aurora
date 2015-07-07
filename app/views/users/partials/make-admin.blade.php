<table id="make-admin">
	<thead>
		<tr class="row make-admin-header">
			<th class="table-cell">
				Danger Zone
			</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="table-cell">
				<h4>Make this user as an admin</h4>
				<p>Admin user is able to modify other users information</p>
		{{ Form::open(['route' => array('admin.create', $user['_id'])]) }}
		{{ Form::submit('Make admin', ['class' => 'button -secondary']) }}
		{{ Form::close() }}
			</td>
		</tr>
	</tbody>
</table>
