<div class="col-12">
    @if($errors->count())
      <div class="alert alert-warning col-12" role="alert">
        <span class='form_error'>{!! $errors->first('fullname') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('title_en') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('title_sw') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('content_en') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('photo_url') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('position') !!}</span> <br />
      <span class='form_error'>{!! $errors->first('category_id') !!}</span>
      </div>
    @endif
</div>

<div class="col-md-12 px-0 mt-0">
  {{-- photo upload --}}
  <div class="card-body px-0 pt-0">
    <div class="row">


      <div class="form-group">
          {!! Form::label('photo_url', ' ') !!}
          {!! Form::hidden('photo_url', null,['id' => 'upload_img','class'=>'form-control']) !!}
      </div>

      <div class="col-md-4 form-group">
        {!! Form::label('salutation_sw', 'Salutation in swahili *') !!}
        {!! Form::text('salutation_sw',null,['class'=>'form-control','placeholder'=>'Dkt']) !!}
      </div>

      <div class="col-md-4 form-group">
        {!! Form::label('salutation_en', 'Salutation in English *') !!}
        {!! Form::text('salutation_en',null,['class'=>'form-control','placeholder'=>'Dr']) !!}
      </div>

      <div class="col-md-4 form-group">
        {!! Form::label('fullname', 'Person Full name') !!}
				{!! Form::text('fullname',null,['class'=>'form-control','placeholder'=>'John D Doe']) !!}
      </div>

      <div class="col-md-4 form-group">
        {!! Form::label('title_sw', 'Title / Position in Swahili *') !!}
        {!! Form::text('title_sw',null,['class'=>'form-control','placeholder'=>'Mkurugenzi']) !!}
      </div>

      <div class="col-md-4 form-group">
        {!! Form::label('title_en', 'Title / Position in English *') !!}
				{!! Form::text('title_en',null,['class'=>'form-control','placeholder'=>'Director']) !!}
      </div>

      <div class="col-md-4 form-group">
        {!! Form::label('email', 'Email Address') !!}
        {!! Form::email('email',null,['class'=>'form-control']) !!}
      </div>
      
      <div class="col-md-4 form-group">
        {!! Form::label('Phone', 'Phone') !!}
        {!! Form::text('phone',null,['class'=>'form-control']) !!}
      </div>

      {{-- <div class="col-12 form-group">
        {!! Form::label('category_id', 'Select Administration Category') !!}
				{!! Form::select('category_id',$categories,null,['class'=>'form-control']) !!}
      </div> --}}

      {{-- <div class="col-12 form-group">
        {!! Form::label('group_id', 'Select Administration Group') !!}
				{!! Form::select('group_id',$groups,null,['class'=>'form-control']) !!}
      </div> --}}

      <div class="col-4 form-group">
        {!! Form::label('position', 'Position') !!}
				{!! Form::select('position', array('0' => 'Other Staff Member','1'=>'Principal / Director General'),null,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('content_sw', 'Description In Swahili') !!}
        {!! Form::textarea('content_sw',null,['id'=>'redactor_sw','class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('content_en', 'Description In English') !!}
        {!! Form::textarea('content_en',null,['id'=>'redactor_en','class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::submit($submitButton, ['class' => 'btn btn-primary col-md-6 offset-md-3']) !!}
      </div>
    </div>
  </div>
</div>
