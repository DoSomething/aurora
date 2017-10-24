@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'Users', 'subtitle' => 'View & edit member profiles.']);

<div class ="container -padded">
  <div class="wrapper">
      <div class="container__block -narrow">
          <h1>Confirm your changes:</h1>
      </div>

      <div class="container__block -half profile-settings">
        <h3>Original Profile</h3>
        @include('users.partials.profile', ['user' => $user])
      </div>

      <div class="container__block -half profile-settings">
        <h3>Merged Profile</h3>
        @include('users.partials.profile', ['user' => $mergedUser])
      </div>

      <div class="container__block -narrow">
        {!! Form::model($user, ['route' => ['users.merge.store', $user->id]]) !!}
        <div class="form-actions">
            {!! Form::submit('Save Changes', ['class' => 'button', 'name' => 'complete']) !!}
        </div>
        {!! Form::close() !!}
      </div>
  </div>
</div>
@stop
