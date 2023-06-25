<div class="row">
    @if($errors->count())
        <div class="alert alert-warning col-12" role="alert">
          <span class='form_error'>{!! $errors->first('feedback_email') !!}</span> <br/>
          <span class='form_error'>{!! $errors->first('whistle_email') !!}</span> <br/>
        </div>
    @endif

     <div class="form-group col-12">
       {!! Form::label('feedback_email', 'Email Address to send Feedback') !!}
       {!! Form::email('feedback_email', null, ['class' => 'form-control']) !!}
     </div>

     <div class="form-group col-12">
       {!! Form::label('whistle_email', 'Email Address to send Whistle Blower') !!}
       {!! Form::email('whistle_email', null, ['class' => 'form-control']) !!}
     </div>

     <div class="form-group col-12">
           {!! Form::submit($submitButton, ['class' => 'btn btn-primary px-5']) !!}
     </div>
 </div>
