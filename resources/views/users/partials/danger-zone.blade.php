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
            <p class="footnote">This will <strong>permanently destroy</strong> this user's Northstar & Customer.io profiles, Rogue campaign activity, and Gambit conversation history.</p>
        </div>
        <div class="form-actions">
            {{ Form::submit('Delete Immediately', [
                'class' => 'button -secondary -danger',
                'data-confirm' => 'Are you sure you want to immediately & permanently destroy all of '.$user->display_name.'\'s data? THIS CANNOT BE UNDONE.'
            ]) }}
        </div>
        {!! Form::close() !!}
    </div>
</div>
