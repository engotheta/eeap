<div class="row">
    @if($errors->count())
    <div class="alert alert-warning col-12" role="alert">
      <span class='form_error'>{!! $errors->first('summary_sw') !!}</span> <br/>
      <span class='form_error'>{!! $errors->first('summary_en') !!}</span> <br/>
      <span class='form_error'>{!! $errors->first('content_sw') !!}</span> <br/>
      <span class='form_error'>{!! $errors->first('content_en') !!}</span>
    </div>
    @endif

     {{-- <div class="form-group col-12">
       {!! Form::label('summary_sw', 'Summary in Swahili [appears on homepage (very brief)]') !!}
       {!! Form::textarea('summary_sw', null, ['class' => 'form-control', 'rows'=>'3']) !!}
     </div> --}}
     
     {{-- <div class="form-group col-12">
       {!! Form::label('summary_en', 'Summary in English [appears on homepage (very brief)]') !!}
       {!! Form::textarea('summary_en', null, ['class' => 'form-control', 'rows'=>'3']) !!}
     </div> --}}
          
     <div class="form-group col-12">
       {!! Form::label('content_sw', 'Content in Swahili') !!}
       {!! Form::textarea('content_sw', null, ['id' => 'redactor_sw', 'class' => 'form-control','rows'=>'3','cols'=>'80']) !!}
     </div>

     <div class="form-group col-12">
       {!! Form::label('content_en', 'Content in english') !!}
       {!! Form::textarea('content_en', null, ['id' => 'redactor_en', 'class' => 'form-control','rows'=>'3','cols'=>'80']) !!}
     </div>

     <div class="form-group col-12">
       <div class="row">
         <div class="form-group col-6 float-left">
           {!! Form::label('status', 'Status') !!}
           {!! Form::select('status', array('1' => 'Active','0'=>'Inactive'), null,['class' => 'form-control'] ) !!}
         </div>

         <div class="col-6 pt-4 " style="margin-top:5px">
           {!! Form::submit($submitButton, ['class' => 'btn btn-primary col-12']) !!}
         </div>
       </div>
     </div>
 </div>
