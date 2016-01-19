<table id="user-table" class="table">
	<thead>
		<tr class="row table-header">
			<th class="table-cell">User Id</th>
			<th class="table-cell">Name</th>
			<th class="table-cell">Email</th>
			<th class="table-cell">Phone</th>
		</tr>
	</thead>
	<tbody>
		@forelse($users as $user)
			<tr class="table-row">
				<td class="table-cell"> <a href="{{ route('users.show', [$user['_id']]) }}">{{ $user['_id'] }}</a></td>
				<td class="table-cell"> {{ $user['first_name'] or '' }} {{ $user['last_name'] or '' }}</td>
				<td class="table-cell"> {{ $user['email']  or '' }}</td>
				<td class="table-cell"> {{ isset($user['mobile']) ? e(sanitize_phone_number($user['mobile'])) : '' }}</td>
			</tr>
		@empty
		@endforelse
	</tbody>
</table>
