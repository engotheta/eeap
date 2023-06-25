<div class="col-12">
    @if($errors->count())
      <div class="alert alert-warning col-12" role="alert">
        <span class='form_error'>{!! $errors->first('name') !!}</span> <br/>
        <span class='form_error'>{!! $errors->first('display_name') !!}</span> <br/>
        <span class='form_error'>{!! $errors->first('description') !!}</span> <br/>
      </div>
    @endif
</div>

<div class="col-md-12 px-0 mt-0">
  <div class="card-body px-0 pt-0">
    <div class="row">
      <div class="col-12 form-group">
        {!! Form::label('name', 'Role Name *') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('display_name', 'DIsplay Name *') !!}
				{!! Form::text('display_name',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('description', 'Description') !!}
        {!! Form::text('description',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::submit($submitButton, ['class' => 'btn btn-primary col-md-12']) !!}
      </div>
    </div>
  </div>
</div>
