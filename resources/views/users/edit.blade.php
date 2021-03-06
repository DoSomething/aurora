@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'Users', 'subtitle' => 'View & edit member profiles.'])

<div class ="container -padded">
  <div class="wrapper">
      <div class="container__block -narrow">
          <h1>{{ $user->display_name }}</h1>

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
              {!! Form::label('voter_registration_status', 'Voter Registration Status', ['class' => 'field-label']) !!}
                  <div class="select">
                      {!! Form::select('voter_registration_status', [
                          'uncertain' => 'Uncertain',
                          'ineligible' => 'Ineligible',
                          'unregistered' => 'Unregistered',
                          'confirmed' => 'Confirmed',
                          'registration_complete' => 'Registration Complete',
                      ], null, ['placeholder' => '--']) !!}
                  </div>
          </div>
          <div class="form-item -padded">
              {!! Form::label('school_id', 'School ID', ['class' => 'field-label']) !!}
              {!! Form::text('school_id', NULL, ['class' => 'text-field']) !!}
          </div>
          <div class="form-item -padded">
              {!! Form::label('club_id', 'Club ID', ['class' => 'field-label']) !!}
              {!! Form::text('club_id', NULL, ['class' => 'text-field']) !!}
          </div>
          <div class="form-item -padded">
              {!! Form::label('email_subscription_topics', 'Email Subscription Topics', ['class' => 'field-label']) !!}
                  <div>
                    {!! Form::checkbox('email_subscription_topics[]', 'community') !!}
                    {!! Form::label('community', 'community') !!}
                  </div>
                  <div>
                    {!! Form::checkbox('email_subscription_topics[]', 'lifestyle') !!}
                    {!! Form::label('lifestyle', 'lifestyle') !!}
                  </div>
                  <div>
                    {!! Form::checkbox('email_subscription_topics[]', 'news') !!}
                    {!! Form::label('news', 'news') !!}
                  </div>
                  <div>
                    {!! Form::checkbox('email_subscription_topics[]', 'scholarships') !!}
                    {!! Form::label('scholarships', 'scholarships') !!}
                  </div>
                  <div>
                    {!! Form::checkbox('email_subscription_topics[]', 'clubs') !!}
                    {!! Form::label('clubs', 'clubs') !!}
                  </div>

          </div>
           <div class="form-item -padded">
              {!! Form::label('causes', 'Cause Interests', ['class' => 'field-label']) !!}
                  <div>
                    {!! Form::checkbox('causes[]', 'animal_welfare') !!}
                    {!! Form::label('animal_welfare', 'animal_welfare') !!}
                  </div>
                  <div>
                    {!! Form::checkbox('causes[]', 'bullying') !!}
                    {!! Form::label('bullying', 'bullying') !!}
                  </div>
                  <div>
                    {!! Form::checkbox('causes[]', 'education') !!}
                    {!! Form::label('education', 'education') !!}
                  </div>
                  <div>
                    {!! Form::checkbox('causes[]', 'environment') !!}
                    {!! Form::label('environment', 'environment') !!}
                  </div>
                   <div>
                    {!! Form::checkbox('causes[]', 'gender_rights_equality') !!}
                    {!! Form::label('gender_rights_equality', 'gender_rights_equality') !!}
                  </div>
                  <div>
                    {!! Form::checkbox('causes[]', 'homelessness_poverty') !!}
                    {!! Form::label('homelessness_poverty', 'homelessness_poverty') !!}
                  </div>
                  <div>
                    {!! Form::checkbox('causes[]', 'immigration_refugees') !!}
                    {!! Form::label('immigration_refugees', 'immigration_refugees') !!}
                  </div>
                  <div>
                    {!! Form::checkbox('causes[]', 'lgbtq_rights_equality') !!}
                    {!! Form::label('lgbtq_rights_equality', 'lgbtq_rights_equality') !!}
                  </div>
                   <div>
                    {!! Form::checkbox('causes[]', 'mental_health') !!}
                    {!! Form::label('mental_health', 'mental_health') !!}
                  </div>
                  <div>
                    {!! Form::checkbox('causes[]', 'physical_health') !!}
                    {!! Form::label('physical_health', 'physical_health') !!}
                  </div>
                  <div>
                    {!! Form::checkbox('causes[]', 'racial_justice_equity') !!}
                    {!! Form::label('racial_justice_equity', 'racial_justice_equity') !!}
                  </div>
                  <div>
                    {!! Form::checkbox('causes[]', 'sexual_harassment_assault') !!}
                    {!! Form::label('sexual_harassment_assault', 'sexual_harassment_assault') !!}
                  </div>
          </div>
            <div class="form-item -padded">
              {!! Form::label('feature_flags', 'Feature Flags', ['class' => 'field-label']) !!}
                  <div>
                    {!! Form::checkbox('feature_flags[]', 'badges', data_get($user, 'feature_flags.badges', false)) !!}
                    {!! Form::label('badges', 'badges') !!}
                  </div>
                  <div>
                    {!! Form::checkbox('feature_flags[]', 'refer-friends',  data_get($user, 'feature_flags.refer-friends', false))!!}
                    {!! Form::label('refer-friends', 'refer-friends') !!}
                    {!! Form::checkbox('feature_flags[]', 'refer-friends-scholarship',  data_get($user, 'feature_flags.refer-friends-scholarship', false))!!}
                    {!! Form::label('refer-friends-scholarship', 'refer-friends-scholarship') !!}
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
