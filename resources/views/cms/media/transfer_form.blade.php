

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
				{!! Form::label('gallery_id', 'Select Gallery') !!}
				{!! Form::select('gallery_id', $galleries,null,['class'=>'form-control']) !!}
      </div>


      <div class="col-12 form-group">
        {!! Form::submit($submitButton, ['class' => 'btn btn-primary col-md-12']) !!}
      </div>
    </div>
  </div>
</div>
