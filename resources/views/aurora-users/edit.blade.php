@extends('layout.master')

@section('main_content')

@include('layout.header', ["header" => "Aurora Users", "subtitle" => "Admins, staff, interns, etc."])

<div class ="container -padded">
  <div class="wrapper">
      <div class="container__block -narrow">
          <h1>Edit Aurora Profile</h1>
          {!! Form::model($auroraUser, ['route' => ['aurora-users.update', $auroraUser->id], 'method' => 'PUT']) !!}
          <div class="form-item -padded">
              {!! Form::label('northstar_id', 'Northstar ID', ['class' => 'field-label']) !!}
              {!! Form::text('northstar_id', $auroraUser->northstar_id, ['class' => 'text-field', 'disabled' => 'true']) !!}
          </div>
          <div class="form-item">
              <label for="role" class="field-label">Aurora Role</label>
              <p class="footnote">This determines a user's abilties on Northstar.</p>
              <div class="select">
                  {!! Form::select('role', $roles, $auroraUser->role) !!}
              </div>
          </div>
          <div class="form-actions -padded">
              {!! Form::submit('Save Changes', ['class' => 'button']) !!}
          </div>
          {!! Form::close() !!}
      </div>
  </div>
</div>
@stop
