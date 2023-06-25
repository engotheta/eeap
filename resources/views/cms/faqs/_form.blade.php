<div class="col-12">
    @if($errors->count())
      <div class="alert alert-warning col-12" role="alert">
        <span class='form_error'>{!! $errors->first('question_sw') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('question_en') !!}</span> <br />
				<span class='form_error'>{!! $errors->first('answer_sw') !!}</span>
				<span class='form_error'>{!! $errors->first('answer_en') !!}</span>

      </div>
    @endif
</div>

<div class="col-md-12 px-0 mt-0">
  {{-- photo upload --}}
  <div class="card-body px-0 pt-0">
    <div class="row">
      <div class="col-12 form-group">
        {!! Form::label('question_sw', 'Question swahili *') !!}
        {!! Form::text('question_sw',null,['class'=>'form-control']) !!}
      </div>
      <div class="col-12 form-group">
        {!! Form::label('question_en', 'Question English *') !!}
        {!! Form::text('question_en',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
				{!! Form::label('answer_sw', 'Swahili answer') !!}
				{!! Form::textarea('answer_sw', null, ['id' => 'redactor_sw', 'class' => 'form-control']) !!}
      </div>

      <div class="col-12 form-group">
				{!! Form::label('answer_en', 'English answer') !!}
				{!! Form::textarea('answer_en', null, ['id' => 'redactor_en', 'class' => 'form-control']) !!}
      </div>

      {{-- <div class="col-12 form-group">
        {!! Form::label('specials', 'Special Page [Option]') !!}
        {!! Form::select('specials', ['' => 'Select Special Page','list'=>$specials], null, array('class' => 'form-control')) !!}
      </div> --}}

      <div class="col-12 form-group">
				{!! Form::label('active', 'Status') !!}
				{!! Form::select('active', array('1' => 'Active','0'=>'Inactive'),null,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::submit($submitButton, ['class' => 'btn btn-primary col-md-12']) !!}
      </div>
    </div>
  </div>
</div>
