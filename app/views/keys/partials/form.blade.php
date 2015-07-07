<div class="container__block">
  <div class="form-item -padded">
	  {{ Form::label('App Name', null, ['class' => 'field-label']) }}

    {{ Form::text('app_name', NULL, ['class' => 'text-field']) }}
	</div>
    {{ Form::submit('Submit', ['class' => 'button']) }}
	</div>
</div>