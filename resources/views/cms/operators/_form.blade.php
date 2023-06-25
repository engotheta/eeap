<div class="col-12">
    @if($errors->count())
      <div class="alert alert-warning col-12" role="alert">
        <span class='form_error'>{!! $errors->first('name') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('phone') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('email') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('address') !!}</span>
      </div>
    @endif
</div>

<div class="col-md-12 px-0 mt-0">
  <div class="card-body mt-0">

    <div class="row">

      <div class="col-12 form-group">
        {!! Form::label('name', 'Operators Name') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
      </div>


      <div class="col-12 form-group">
        {!! Form::label('phone', 'Phone') !!}
        {!! Form::text('phone',null,['class'=>'form-control']) !!}
      </div>


      <div class="col-12 form-group">
        {!! Form::label('email', 'Email') !!}
				{!! Form::text('email', null, ['id' => 'd', 'class' => 'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('address', 'Address') !!}
        {!! Form::text('address', null, ['id' => 'dj', 'class' => 'form-control']) !!}
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
