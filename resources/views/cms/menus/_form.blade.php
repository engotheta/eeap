<div class="col-12">
    @if($errors->count())
      <div class="alert alert-warning col-12" role="alert">
        <span class='form_error'>{!! $errors->first('title_en') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('title_sw') !!}</span> <br />
				<span class='form_error'>{!! $errors->first('main_nav') !!}</span>
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
				{!! Form::label('category', 'Menu Type') !!}
				{!! Form::select('category', array(
          'Main Categories' =>['top_menu'=>'Top Header Menu','main_nav' => 'Main Menu','footer_menu'=>'Footer Menu'],
          'Special Pages' =>$specialPage), null, array('class' => 'form-control')) !!}
				{{-- {!! Form::select('category', array('main_nav' => 'Main Menu','mega_nav'=>'Mega Menu','footer_menu'=>'Footer Menu'), null, array('class' => 'form-control')) !!} --}}
      </div>

      <div class="col-12 form-group">
        {!! Form::submit($submitButton, ['class' => 'btn btn-primary col-md-12']) !!}
      </div>
    </div>
  </div>
</div>
