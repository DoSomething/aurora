<table id="user-table" class="table">
	<thead>
		<tr class="row table-header">
			<th class="table-cell">User</th>
			<th class="table-cell">Email</th>
			<th class="table-cell">Phone</th>
		</tr>
	</thead>
	<tbody>
		@forelse($users as $user)
			<tr class="table-row">
				<td class="table-cell"><a href="{{ route('users.show', [$user->id]) }}">{{ $user->displayName() }}</a></td>
				<td class="table-cell">{{ $user->email or '' }}</td>
				<td class="table-cell">{{ $user->prettyMobile() }}</td>
			</tr>
		@empty
		@endforelse
	</tbody>
</table>
