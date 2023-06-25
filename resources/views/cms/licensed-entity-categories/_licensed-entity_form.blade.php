<div class="col-12">
    @if($errors->count())
      <div class="alert alert-warning col-12" role="alert">
        <span class='form_error'>{!! $errors->first('name') !!}</span> <br/>
        <span class='form_error'>{!! $errors->first('principal_officer') !!}</span> <br/>
        <span class='form_error'>{!! $errors->first('region') !!}</span> <br/>
        <span class='form_error'>{!! $errors->first('address') !!}</span> <br/>
        <span class='form_error'>{!! $errors->first('email') !!}</span> <br/>
        <span class='form_error'>{!! $errors->first('license_type') !!}</span> <br/>
        <span class='form_error'>{!! $errors->first('phone') !!}</span> <br/>
        <span class='form_error'>{!! $errors->first('category_id') !!}</span> <br/>
        <span class='form_error'>{!! $errors->first('class_of_business') !!}</span> <br/>
      </div>
    @endif
</div>


<div class="col-md-12 px-0 mt-0">
  {{-- photo upload --}}
  <div class="card-body px-0 pt-0">

    <div class="row">
      <div class="col-6 col-md-6 form-group">
        {!! Form::label('name', 'Enitity Name *') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-6 col-md-6 form-group">
        {!! Form::label('principal_officer', 'Principal Officer Name *') !!}
        {!! Form::text('principal_officer', null, ['id' => 'dj', 'class' => 'form-control']) !!}
      </div>

      <div class="col-6 col-md-6 form-group">
        {!! Form::label('phone', 'Mobile Phone') !!}
        {!! Form::text('phone',null,['class'=>'form-control']) !!}
      </div>

      {{-- <div class="col-6 col-md-4 form-group">
        {!! Form::label('telephone', 'Telephone') !!}
        {!! Form::text('telephone',null,['class'=>'form-control']) !!}
      </div> --}}

      {{-- <div class="col-6 col-md-4 form-group">
        {!! Form::label('fax', 'Fax') !!}
        {!! Form::text('fax',null,['class'=>'form-control']) !!}
      </div> --}}

      <div class="col-6 col-md-6 form-group">
        {!! Form::label('email', 'Email') !!}
				{!! Form::text('email', null, ['id' => 'd4', 'class' => 'form-control']) !!}
      </div>

      <div class="col-6 col-md-4 form-group">
        {!! Form::label('website', 'Website') !!}
				{!! Form::text('website', null, ['id' => 'da', 'class' => 'form-control']) !!}
      </div>
      

      <div class="col-6 col-md-4  form-group">
        {!! Form::label('class_of_business', 'Class of Business') !!}
        {!! Form::select('class_of_business', 
        array(
          '' => '',
          'Both' => 'Both',
          'Life'=>'Life',
	        'Non-Life'=>'Non-Life'
        )
        ,null,['class'=>'form-control']) !!}
      </div>

      <div class="col-6 col-md-4  form-group">
        {!! Form::label('license_type', 'License Type') !!}
        {!! Form::select('license_type', 
        array(
          '' => '',
          'Perpetual' => 'Perpetual',
          '3 years'=>'3 Years',
          '1 year'=>'1 Year',
        )
        ,null,['class'=>'form-control']) !!}
      </div>

      <div class="col-6 col-md-4 form-group">
        {!! Form::label('principal_insurer_1', 'CEO') !!}
				{!! Form::text('principal_insurer_1', null, ['id' => 'd5s534', 'class' => 'form-control']) !!}
      </div>

      <div class="col-6 col-md-4 form-group">
        {!! Form::label('principal_insurer_2', 'Address') !!}
				{!! Form::text('principal_insurer_2', null, ['id' => 'd5s5g34', 'class' => 'form-control']) !!}
      </div>

      <div class="col-6 col-md-4 form-group">
        {!! Form::label('principal_insurer_3', 'Principal Insurer') !!}
				{!! Form::text('principal_insurer_3', null, ['id' => 'd5s5g34', 'class' => 'form-control']) !!}
      </div>

      <div class="col-6 col-md-4  form-group">
        {!! Form::label('number_of_employees', 'Number of Employees') !!}
				{!! Form::number('number_of_employees', null, ['id' => 'd5s3554', 'class' => 'form-control']) !!}
      </div>

      <div class="col-6 col-md-4  form-group">
        {!! Form::label('country', 'Country') !!}
				{!! Form::text('country', null, ['id' => 'd5s34', 'class' => 'form-control']) !!}
      </div>

      <div class="col-6 col-md-4  form-group">
        {!! Form::label('region', 'Region') !!}
				{!! Form::text('region', null, ['id' => 'd5', 'class' => 'form-control']) !!}
      </div>


      <div class="col-6 col-md-4  form-group">
        {!! Form::label('district', 'district') !!}
				{!! Form::text('district', null, ['id' => 'd53d4', 'class' => 'form-control']) !!}
      </div>

      <div class="col-6 col-md-4  form-group">
        {!! Form::label('date_of_application', 'Date of License') !!}
        {!! Form::input('date', 'date_of_application',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-6 col-md-4  form-group">
        {!! Form::label('date_of_license', 'Date of Application') !!}
        {!! Form::input('date', 'date_of_license',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-6 col-md-4  form-group">
        {!! Form::label('status', 'Status (Active | Inactive') !!}
				{!! Form::text('status', null, ['id' => 'd534', 'class' => 'form-control']) !!}
      </div>

  
      <div class="col-6 col-md-4  form-group">
        {!! Form::label('active', 'Status') !!}
        {!! Form::select('active', array('1' => 'Active','0'=>'Inactive'),null,['class'=>'form-control']) !!}
      </div>


      <div class="col-12 form-group">
        {!! Form::label('address', 'Full Address') !!}
				{!! Form::textarea('address', null, ['id' => 'redactor_address', 'rows'=> 3, 'class' => 'form-control']) !!}
      </div>

      <div class="col-12 form-group" style="display:none">
        {!! Form::label('category_id', 'Publication Category') !!}
        {!! Form::text('category_id',$selected_category->id,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::submit($submitButton, ['class' => 'btn btn-primary saving-button col-md-12']) !!}
      </div>
    </div>
  </div>
</div>
