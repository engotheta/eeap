<div class="col-12">
    @if($errors->count())
      <div class="alert alert-warning col-12" role="alert">
        <span class='form_error'>{!! $errors->first('title') !!}</span>
        <span class='form_error'>{!! $errors->first('url') !!}</span>
      </div>
    @endif
</div>

<div class="col-md-12 px-0 mt-0">
  {{-- photo upload --}}
  <div class="card-body px-0 pt-0">
    <div class="row">
      <div class="col-12 form-group">
        {!! Form::label('title_en', 'Social link title') !!}
        {!! Form::select('title_en', $social_media, null, ['class'=>'form-control']) !!}
      </div>


      <div class="col-12 form-group">
        {!! Form::label('url', "Link/URL *") !!}
				{!! Form::input('url', 'url', null, array('required' => 'required','class'=>'form-control')) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::submit($submitButton, ['class' => 'btn btn-primary col-md-12']) !!}
      </div>
    </div>
  </div>
</div>
