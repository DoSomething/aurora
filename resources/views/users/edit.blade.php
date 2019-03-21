@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'Users', 'subtitle' => 'View & edit member profiles.']);

<div class ="container -padded">
  <div class="wrapper">
      <div class="container__block -narrow">
          <h1>{{ $user->displayName() }}</h1>

          @include('layout.errors')

          {!! Form::model($user, [ 'method' => 'PATCH', 'route' => ['users.update', $user->id]]) !!}
          <div class="form-item -padded">
              {!! Form::label('first_name', 'First Name', ['class' => 'field-label']) !!}
              {!! Form::text('first_name', NULL, ['class' => 'text-field']) !!}
          </div>
          <div class="form-item -padded">
              {!! Form::label('last_name', 'Last Name', ['class' => 'field-label']) !!}
              {!! Form::text('last_name', NULL, ['class' => 'text-field']) !!}
          </div>
          <div class="form-item -padded">
              {!! Form::label('email', 'Email', ['class' => 'field-label']) !!}
              {!! Form::text('email', NULL, ['class' => 'text-field']) !!}
          </div>
          <div class="form-item -padded">
              {!! Form::label('mobile', 'Mobile', ['class' => 'field-label']) !!}
              {!! Form::text('mobile', NULL, ['class' => 'text-field']) !!}
          </div>
          <div class="form-item -padded">
              {!! Form::label('birthdate', 'Birthdate', ['class' => 'field-label']) !!}
              {!! Form::text('birthdate', NULL, ['class' => 'text-field']) !!}
          </div>
          <div class="form-item -padded">
              {!! Form::label('addr_street1', 'Address St 1', ['class' => 'field-label']) !!}
              {!! Form::text('addr_street1', NULL, ['class' => 'text-field']) !!}
          </div>
          <div class="form-item -padded">
              {!! Form::label('addr_street2', 'Address St 2', ['class' => 'field-label']) !!}
              {!! Form::text('addr_street2', NULL, ['class' => 'text-field']) !!}
          </div>
          <div class="form-item -padded">
              {!! Form::label('addr_city', 'City', ['class' => 'field-label']) !!}
              {!! Form::text('addr_city', NULL, ['class' => 'text-field']) !!}
          </div>
          <div class="form-item -padded">
              {!! Form::label('addr_state', 'State', ['class' => 'field-label']) !!}
              {!! Form::text('addr_state', NULL, ['class' => 'text-field']) !!}
          </div>
          <div class="form-item -padded">
              {!! Form::label('addr_zip', 'Zipcode', ['class' => 'field-label']) !!}
              {!! Form::text('addr_zip', NULL, ['class' => 'text-field']) !!}
          </div>
          <div class="form-item -padded">
              {!! Form::label('country', 'Country', ['class' => 'field-label']) !!}
              {!! Form::text('country', NULL, ['class' => 'text-field']) !!}
          </div>
          <div class="form-item -padded">
              {!! Form::label('sms_status', 'SMS Status', ['class' => 'field-label']) !!}
                  <div class="select">
                      {!! Form::select('sms_status', [
                          'active' => 'Active Subscriber',
                          'less' => 'Active Subscriber (Less)',
                          'stop' => 'Unsubscribed (texted STOP)',
                          'undeliverable' => 'Undeliverable',
                          'unknown' => 'Unknown Issue'
                      ], null, ['placeholder' => '--']) !!}
                  </div>
          </div>
          <div class="form-item -padded">
              {!! Form::label('email_subscription_status', 'Email Subscription Status', ['class' => 'field-label']) !!}
                  <div class="select">
                      {!! Form::select('email_subscription_status', [
                          true => 'Subscribed',
                          false => 'Unsubscribed',
                      ], null, ['placeholder' => '--']) !!}
                  </div>
          </div>
          <div class="form-item -padded">
              {!! Form::label('email_subscription_topics', 'Email Subscription Topics', ['class' => 'field-label']) !!}
                  <div class="select">
                    {!! Form::select(
                      'email_subscription_topics', [
                        'news' => 'news',
                        'scholarships' => 'scholarships',
                        'lifestyle' => 'lifestyle',
                        'community' => 'community',
                      ], null, ['multiple' => 'multiple', 'name' => 'email_subscription_topics[]']) !!}
                  </div>
          </div>
          @if (auth()->user()->hasRole('admin'))
              <div class="form-item -padded">
                  {!! Form::label('role', 'Role', ['class' => 'field-label']) !!}
                  <div class="select">
                      {!! Form::select('role', ['user' => 'User (default)', 'staff' => 'Staff', 'admin' => 'Administrator']) !!}
                  </div>
              </div>
          @endif
          <div class="form-actions">
              {!! Form::submit('Save Changes', ['class' => 'button', 'name' => 'complete']) !!}
          </div>
          {!! Form::close() !!}
      </div>
  </div>
</div>
@stop
