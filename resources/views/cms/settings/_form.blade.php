<div class="col-12">
    @if($errors->count())
      <div class="alert alert-warning col-12" role="alert">
        <span class='form_error'>{!! $errors->first('content_sw') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('content_en') !!}</span> <br />
      </div>
    @endif
</div>

<div class="col-md-12 px-0 mt-0">
  {{-- photo upload --}}
  <div class="card-body px-0 pt-0">
    <div class="row">
      <div class="col-12 form-group">
        {!! Form::label('title_en', 'Title In English') !!}
  			{!! Form::text('title_en', null, ['class' => 'form-control']) !!}
      </div>
      <div class="col-12 form-group">
        {!! Form::label('title_sw', 'Title In swwahili') !!}
  			{!! Form::text('title_sw', null, ['class' => 'form-control']) !!}
      </div>
      <div class="col-12 form-group">
        {!! Form::label('content_sw', 'Swahili content') !!}
  			{!! Form::textarea('content_sw', null, ['id' => 'redactor_sw', 'class' => 'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('content_en', 'English content') !!}
  			{!! Form::textarea('content_en', null, ['id' => 'redactor_en', 'class' => 'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::submit($submitButton, ['class' => 'btn btn-primary col-md-6 offset-md-3']) !!}
      </div>
    </div>
  </div>
</div>
