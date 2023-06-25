<div class="col-md-12">
    @if($errors->count())
      <div class="alert alert-warning col-md-4" role="alert">
				<span class='form_error'>{!! $errors->first('name_en') !!}</span><br>
				<span class='form_error'>{!! $errors->first('name_sw') !!}</span><br>
				<span class='form_error'>{!! $errors->first('email') !!}</span><br>
				<span class='form_error'>{!! $errors->first('phone') !!}</span><br>
				<span class='form_error'>{!! $errors->first('physical_address_en') !!}</span> <br />
				<span class='form_error'>{!! $errors->first('physical_address_sw') !!}</span> <br />
				<span class='form_error'>{!! $errors->first('fax') !!}</span><br>
				<span class='form_error'>{!! $errors->first('toll_free') !!}</span>
      </div>
    @endif
</div>

<div class="col-md-12 px-0 mt-0">
  {{-- photo upload --}}
  <div class="card-body px-0 pt-0">
    <div class="row">
      <div class="col-md-4 form-group">
				{!! Form::label('name_en', 'Office Name in English') !!}
				{!! Form::text('name_en',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-md-4 form-group">
				{!! Form::label('name_sw', 'Office Name in Swahili') !!}
				{!! Form::text('name_sw',null,['class'=>'form-control']) !!}
      </div>

      {{-- <div class="col-md-4 form-group">
				{!! Form::label('latitude', 'HQ Latitude') !!}
				{!! Form::text('latitude',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-md-4 form-group">
				{!! Form::label('longitude', 'HQ Longitude') !!}
				{!! Form::text('longitude',null,['class'=>'form-control']) !!}
      </div> --}}

      <div class="col-md-4 form-group">
				{!! Form::label('phone', 'Phone Number') !!}
				{!! Form::text('phone',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-md-4 form-group">
				{!! Form::label('toll_free', 'Toll Free Number') !!}
				{!! Form::text('toll_free',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-md-4 form-group">
				{!! Form::label('fax', 'Fax') !!}
				{!! Form::text('fax',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-md-4 form-group">
				{!! Form::label('email', 'Email Address') !!}
				{!! Form::email('email',null,['class'=>'form-control']) !!}
      </div>

	<div class="col-md-4 form-group" style="display:none">
		{!! Form::label('used_as', 'Used as ') !!}
		{!! Form::select('used_as', ['1' => 'Contact us Address'],1,['class'=>'form-control disabled']) !!}
	</div>

      <div class="col-md-4 form-group">
				{!! Form::label('headquarter', 'HQ ') !!}
				{!! Form::select('headquarter', ['0' => 'Not HQ', '1' => 'HQ'],null,['class'=>'form-control']) !!}
			</div>

      <div class="col-md-4 form-group">
				{!! Form::label('physical_address_sw', 'Physical Address in Kiswahili') !!}
				{!! Form::textarea('physical_address_sw', null, ['class' => 'form-control','rows'=>'4']) !!}
      </div>

      <div class="col-md-4 form-group">
				{!! Form::label('physical_address_en', 'Physical Address in English') !!}
				{!! Form::textarea('physical_address_en', null, ['class' => 'form-control','rows'=>'4']) !!}
      </div>


{{--
			<div class="col-md-4 form-group">
				{!! Form::label('used_as', 'Used as ') !!}
				{!! Form::select('used_as', ['1' => 'Contact us Address','2' => 'Complainants Address'],null,['class'=>'form-control']) !!}
			</div> --}}


      {{-- <div class="col-md-12 form-group">
				{!! Form::label('content_sw', 'Description in Swahili') !!}
				{!! Form::textarea('content_sw', null, ['id' => 'redactor_sw', 'class' => 'form-control']) !!}
      </div> --}}

      {{-- <div class="col-md-12 form-group">
				{!! Form::label('content_en', 'Description in english') !!}
				{!! Form::textarea('content_en', null, ['id' => 'redactor_en', 'class' => 'form-control']) !!}
      </div> --}}

      <div class="col-md-12 form-group">
        {!! Form::submit($submitButton, ['class' => 'btn btn-primary col-md-6 offset-md-3']) !!}
      </div>
    </div>
  </div>
</div>
