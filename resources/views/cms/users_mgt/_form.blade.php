<div class="col-12 px-0">
  @if($errors->count())
      <div class="alert alert-warning col-12 px-0" role="alert">
        <span class='form_error'>{!! $errors->first('name') !!}</span> <br/>
        <span class='form_error'>{!! $errors->first('email') !!}</span> <br/>
      </div>
    @endif
</div>

<div class="col-md-12 px-0 mt-0">
  {{-- photo upload --}}
  <div class="card-body px-0 pt-0">
    <div class="row">
      <div class="col-12 form-group">
        {!! Form::label('name', 'Name *') !!}
        {!! Form::text('name',null,['class'=>'form-control','required'=>'required']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('email', 'E-mail *') !!}
				{!! Form::email('email',null,['class'=>'form-control','required'=>'required']) !!}
      </div>

			<?php // TODO: create this option and tracking activities of user ?>
      {{-- <div class="col-12 form-group">
        {!! Form::label('expiring_date', 'Expiration Date*') !!}
				{!! Form::date('expiring_date',null,['class'=>'form-control']) !!}
      </div> --}}

      <div class="col-12 form-group">
        {!! Form::label('role', 'Role*') !!}
				{!! Form::select('role',$roles,null,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::submit($submitButton, ['class' => 'btn btn-primary col-md-12']) !!}
      </div>
    </div>
  </div>
</div>
