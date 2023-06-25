<div class="col-12">
    @if($errors->count())
      <div class="alert alert-warning col-12" role="alert">
				<span class='form_error'>{!! $errors->first('title_sw') !!}</span><br>
				<span class='form_error'>{!! $errors->first('title_en') !!}</span><br>
				{{-- <span class='form_error'>{!! $errors->first('content_sw') !!}</span><br> --}}
				{{-- <span class='form_error'>{!! $errors->first('content_en') !!}</span><br> --}}
				<span class='form_error'>{!! $errors->first('type') !!}</span>
      </div>
    @endif
</div>

<div class="col-md-12 px-0 mt-0">
  {{-- photo upload --}}
  <div class="card-body px-0 pt-0">
    <div class="row">
      <div class="col-12 form-group">
        {!! Form::label('title_sw', 'Title in in swahili *') !!}
        {!! Form::text('title_sw',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('title_en', 'Title in  english *') !!}
				{!! Form::text('title_en',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
				{!! Form::label('content_sw', 'Swahili Description') !!}
				{!! Form::textarea('content_sw',null,['class'=>'form-control','rows'=>'3']) !!}
      </div>

      <div class="col-12 form-group">
				{!! Form::label('content_en', 'English Content') !!}
				{!! Form::textarea('content_en',null,['class'=>'form-control','rows'=>'3']) !!}
      </div>

      {{-- <div class="col-12 form-group">
				{!! Form::label('featured', ' To Be Used as a Slider') !!}
				{!! Form::checkbox('featured',null,['class'=>'form-control']) !!}
      </div> --}}

      <div class="col-12 form-group">
				{!! Form::label('type', 'Category') !!}
				{!! Form::select('type', array('' => 'Select Gallery Type','photos'=>'Photos','videos'=>'Videos'), null, array('class' => 'form-control')) !!}
      </div>

        <div class="col-12 form-group">
          {!! Form::label('featured', 'HomePage Usage [Option]') !!}
  				{!! Form::select('featured', array(0=>'Not Display On HomePage',1 => 'Display HomePage'), null, array('class' => 'form-control')) !!}
        </div>

        {{-- <div class="col-12 form-group">
          {!! Form::label('specials', 'Special Page [Option]') !!}
  				{!! Form::select('specials', ['' => 'Select Special Page','list'=>$specials], null, array('class' => 'form-control')) !!}
        </div> --}}

      <div class="col-12 form-group">
        {!! Form::submit($submitButton, ['class' => 'btn btn-primary col-md-6 offset-md-3']) !!}
      </div>
    </div>
  </div>
</div>
