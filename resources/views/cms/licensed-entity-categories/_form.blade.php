<div class="col-12">
    @if($errors->count())
      <div class="alert alert-warning col-12" role="alert">
        <span class='form_error'>{!! $errors->first('title_en') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('title_sw') !!}</span> <br />
      </div>
    @endif
</div>

<div class="col-md-12 px-0 mt-0">
  <div class="card-body px-0 pt-0">
    <div class="row">

      <div class="col-12 form-group">
        {!! Form::label('title_sw', 'Category title in swahili *') !!}
        {!! Form::text('title_sw',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('title_en', 'Category title in  english *') !!}
				{!! Form::text('title_en',null,['class'=>'form-control']) !!}
      </div>


     <?php $default = isset($category)? $category->featured: null ?>
     <?php if(isset($category)) $default = $category->featured?>
     {{-- <div class="col-12 form-group">
       {!! Form::label('featured', 'Show on Homepage') !!}
       {!! Form::select('featured', array(1 => 'YES',0 =>'NO'), $default, array('class' => 'form-control')) !!}
     </div> --}}

     {{-- <div class="col-12 form-group">
       {!! Form::label('services', 'Service [Option]') !!}
       {!! Form::select('services', ['' => 'Select Service','list'=>$services], null, array('class' => 'form-control')) !!}
     </div> --}}

     {{-- <div class="col-12 form-group">
       {!! Form::label('specials', 'Special Page [Option]') !!}
       {!! Form::select('specials', ['' => 'Select Special Page','list'=>$specials], null, array('class' => 'form-control')) !!}
     </div> --}}

      <div class="col-12 form-group">
        {!! Form::submit($submitButton, ['class' => 'btn btn-primary col-md-12']) !!}
      </div>
    </div>
  </div>
</div>
