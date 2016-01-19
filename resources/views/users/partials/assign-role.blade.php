<!-- Assign role -->
@if(!in_array("admin", $user_roles))
    <div class="danger-zone">
        <h4 class="danger-zone__heading">Danger Zone</h4>

        {!! Form::open(['route' => ['role.create', $northstar_profile['_id']]]) !!}
        <div class="form-item">
            <label for="role" class="field-label">Assign Aurora Role</label>
            <div class="select">
                {!! Form::select('role', $unassigned_roles) !!}
            </div>
        </div>
        <div class="form-actions">
            {!! Form::submit('Submit', ['name' => 'type', 'class' => 'button -secondary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endif

<!-- Remove role in hierarchy -->
@if (!empty($user_roles))
    <div class="danger-zone">
        <h4 class="danger-zone__heading">Danger Zone</h4>
        <p>This user is assigned the <strong>{{ value(array_slice($user_roles, -1, 1)[0]) }}</strong> role.</p>
        <div class="form-item -padded">
            {!! Form::model($northstar_profile, ['route' => array('users.destroy', $northstar_profile['_id']), 'method' => 'delete']) !!}
            {!! Form::hidden('role', value(array_slice($user_roles, -1, 1)[0]) ) !!}
            {!! Form::submit('Remove Aurora role', ['name' => 'type', 'class' => 'button -secondary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endif
