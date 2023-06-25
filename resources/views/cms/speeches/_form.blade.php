<div class="col-12">
    @if($errors->count())
      <div class="alert alert-warning col-12" role="alert">
        <span class='form_error'>{!! $errors->first('file_sw') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('file_en') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('name_sw') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('name_en') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('content_en') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('content_sw') !!}</span>
      </div>
    @endif
</div>

<div class="col-md-12 px-0 mt-0">
  <div class="card-body mt-0">
    <div class="row">
      
      <div class="col-12 form-group">
        {!! Form::label('file_sw', 'File in Swahili (use PDF)') !!}
        {!! Form::file('file_sw',['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('file_en', 'File in English (use PDF)') !!}
        {!! Form::file('file_en',['class'=>'form-control']) !!}
      </div>

      <hr>

      <div class="col-12 form-group">
        {!! Form::label('name_sw', 'Title/Name in Swahili') !!}
        {!! Form::text('name_sw',null,['class'=>'form-control']) !!}
      </div>


      <div class="col-12 form-group">
        {!! Form::label('name_en', 'Title/Name in English') !!}
        {!! Form::text('name_en',null,['class'=>'form-control']) !!}
      </div>


      <div class="col-12 form-group">
        {!! Form::label('content_sw', 'Content Summary in Swahili') !!}
				{!! Form::textarea('content_sw', null, ['id' => 'redactor_sw', 'class' => 'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('content_en', 'ContentSummary in English') !!}
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
