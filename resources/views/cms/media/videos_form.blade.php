<div class="col-12">
    @if($errors->count())
      <div class="alert alert-warning col-12" role="alert">
        <span class='form_error'>{!! $errors->first('title') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('url') !!}</span><br>
				<span class='form_error'>{!! $errors->first('content_sw') !!}</span><br>
				<span class='form_error'>{!! $errors->first('mediaurl') !!}</span><br>
      </div>
    @endif
</div>

<div class="col-md-12 px-0 mt-0">

  <div class="card-body px-0 pt-0">
    <div class="row">
      <div class="col-12 form-group">
        {!! Form::label('title_sw', 'Caption in swahili *') !!}
        {!! Form::text('title_sw',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('title_en', 'Caption in  english *') !!}
				{!! Form::text('title_en',null,['class'=>'form-control']) !!}
      </div>

      <div class="form-group" style="display:none">
        {!! Form::label('mediaurl', ' ') !!}
        {!! Form::hidden('mediaurl', null,['id' => 'upload_img','class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
				{!! Form::label('url', 'Youtube Video') !!}
				{!! Form::text('url',null,['class'=>'form-control']) !!}
      </div>


      <div class="col-12 form-group">
        {!! Form::submit($submitButton, ['class' => 'btn btn-primary col-md-12']) !!}
      </div>
    </div>
  </div>
</div>
