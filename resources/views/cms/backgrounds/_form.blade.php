<div class="row">
    @if($errors->count())
    <div class="alert alert-warning col-12" role="alert">
      <span class='form_error'>{!! $errors->first('main_bg') !!}</span> <br/>
      {{-- <span class='form_error'>{!! $errors->first('banner_bg') !!}</span> <br> --}}
      {{-- <span class='form_error'>{!! $errors->first('second_bg') !!}</span> --}}
    </div>
    @endif
     
    <div class="form-group col-12">
      {!! Form::label('main_bg', '* Main Background Photo [use Quality Photo - ratio 16:9]') !!}
      {!! Form::file('main_bg', ['class' => 'form-control', 'accept' => 'image/*']) !!}
    </div>
     
     {{-- <div class="form-group col-12">
       {!! Form::label('banner_bg', '* Banner Background - appears on Innerpages [use Quality Photo - ratio 5:1]') !!}
       {!! Form::file('banner_bg', ['class' => 'form-control', 'accept' => 'image/*']) !!}
     </div> --}}
     
    {{-- <div class="form-group col-12">
      {!! Form::label('second_bg', 'Second HomePage Background (optional) [use Quality Photo - ratio 16:9]') !!}
      {!! Form::file('second_bg', ['class' => 'form-control', 'accept' => 'image/*']) !!}
    </div> --}}

     <div class="col-6 pt-4 " style="margin-top:5px">
      {!! Form::submit($submitButton, ['class' => 'btn btn-primary col-12']) !!}
    </div>

 </div>
