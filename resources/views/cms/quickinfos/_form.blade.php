<div class="col-12">
    @if($errors->count())
      <div class="alert alert-warning col-12" role="alert">
        <span class='form_error'>{!! $errors->first('info_en') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('info_sw') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('active') !!}</span>
      </div>
    @endif
</div>

<div class="col-md-12 px-0 mt-0">
  <div class="card-body mt-0">

    <div class="row">

      <div class="col-12 form-group">
        {!! Form::label('info_en', 'Information in English') !!}
        {!! Form::text('info_en',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('info_sw', 'Information in Kiswahili') !!}
        {!! Form::text('info_sw',null,['class'=>'form-control']) !!}
      </div>

    </div>


    <div class="row">

      <div class="col-6 form-group">
        {!! Form::label('active', 'Status') !!}
				{!! Form::select('active', array('1' => 'Published','0'=>'UnPublished'),null,['class'=>'form-control']) !!}
      </div>

      <div class="col-6 form-group pt-4">
        	{!! Form::submit($submitButton, ['class' => 'btn btn-primary col-md-12']) !!}
      </div>

    </div>

  </div>
</div>
