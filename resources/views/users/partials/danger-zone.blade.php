<div class="danger-zone">
    <h4 class="danger-zone__heading">Danger Zone&#8482;</h4>
    <div class="danger-zone__block">
        @include('users.partials.resets')
    </div>
    <div class="danger-zone__block">
        {!! Form::open(['route' => ['users.merge.create', $user->id], 'method' => 'GET']) !!}
        <div class="form-item">
            {!! Form::label('id', 'Merge Account', ['class' => 'field-label']) !!}
            <p class="footnote">This will merge the account with given ID <strong>into this user's account</strong>. The user with the ID entered below will be deleted.</p>
        </div>
        <div class="form-item -padded">
          {!! Form::text('id', NULL, ['class' => 'text-field', 'placeholder' => 'Paste a Northstar ID here!']) !!}
        </div>
        <div class="form-actions">
            {!! Form::submit('Merge User', ['class' => 'button -secondary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
    <div class="danger-zone__block">
        {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE']) !!}
        <div class="form-item">
            <label for="role" class="field-label">Delete Account</label>
            <p class="footnote">This will <strong>permanently remove</strong> a user's account from Northstar.
                This is the point of no return! Beware!</p>
        </div>
        <div class="form-actions">
            {!! Form::submit('Delete User', ['class' => 'button -secondary -danger']) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>
