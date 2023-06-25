<div class="col-12">
    @if($errors->count())
      <div class="alert alert-warning col-12" role="alert">
        <span class='form_error'>{!! $errors->first('title_sw') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('title_en') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('content_en') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('content_sw') !!}</span>
      </div>
    @endif
</div>

<div class="col-md-12 px-0 mt-0">
  <div class="card-body mt-0">

    <div class="row">

      <div class="col-12 form-group">
        {!! Form::label('title_sw', 'Title in Swahili') !!}
        {!! Form::text('title_sw',null,['class'=>'form-control']) !!}
      </div>


      <div class="col-12 form-group">
        {!! Form::label('title_en', 'Title in English') !!}
        {!! Form::text('title_en',null,['class'=>'form-control']) !!}
      </div>


      <div class="col-12 form-group">
        {!! Form::label('content_sw', 'Content in Swahili') !!}
				{!! Form::textarea('content_sw', null, ['id' => 'redactor_sw', 'class' => 'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('content_en', 'Content in English') !!}
        {!! Form::textarea('content_en', null, ['id' => 'redactor_en', 'class' => 'form-control']) !!}
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
