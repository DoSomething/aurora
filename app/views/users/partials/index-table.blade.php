<table id="user-table">
	<thead>
		<tr class="row table-header">
			<th class="table-cell">User Id</th>
			<th class="table-cell">First Name</th>
			<th class="table-cell">Last Name</th>
			<th class="table-cell">Email</th>
			<th class="table-cell">Phone</th>
		</tr>
	</thead>
	<tbody>
		@forelse($users as $user)
			<tr class="table-row">
				<td class="table-cell"> {{ link_to_route('users.show', $user['_id'], array($user['_id'])) }}</td>
				<td class="table-cell"> {{{ $user['first_name'] or '' }}}</td>
				<td class="table-cell"> {{{ $user['last_name'] or '' }}}</td>
				<td class="table-cell"> {{{ $user['email']  or '' }}}</td>
				<td class="table-cell"> {{{ isset($user['mobile']) ? e(sanitize_phone_number($user['mobile']), isset($user['country']) ? e($user['country']) : "") : '' }}}</td>
			</tr>
		@empty
		@endforelse
	</tbody>
</table>
