<div class="col-12">
    @if($errors->count())
      <div class="alert alert-warning col-12" role="alert">
        <span class='form_error'>{!! $errors->first('title_en') !!}</span> <br/>
        <span class='form_error'>{!! $errors->first('title_sw') !!}</span> <br/>
      </div>
    @endif
</div>

<div class="col-md-12 px-0 mt-0"> 
  {{-- photo upload --}}
  <div class="card-body px-0 pt-0">
    <div class="row">
      <div class="col-12 form-group">
        {!! Form::label('title_sw', 'Quick Link title in in swahili *') !!}
        {!! Form::text('title_sw',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('title_en', 'Quick Link title in  english *') !!}
				{!! Form::text('title_en',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('title_en', 'Please select a type of link you want to create') !!}<br>
        {!! Form::radio('link', 1, true, array('class' => 'int_link')) !!}
        {!! Form::label('link', 'Internal link') !!}

        {!! Form::radio('link', 0, false, array('class' => 'ext_link')) !!}
        {!! Form::label('link', 'External link') !!}
      </div>

      <div class="col-12 form-group external">
        {!! Form::label('url', "External Link / URL *") !!}
        {!! Form::input('url', 'url_external', null, array('class'=>'form-control')) !!}
      </div>

      <div class="col-12 form-group internal">
        {!! Form::label('url', "internal Link/URL *") !!}
        {!! Form::select('url', $selectMenu, null, array('class' => 'form-control'))!!}
      </div>

      <div class="col-12 form-group" style="display:none">
        {!! Form::label('category_id', 'Publication Category') !!}
        {!! Form::text('category_id',$category->id,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::submit($submitButton, ['class' => 'btn btn-primary col-md-12']) !!}
      </div>
    </div>
  </div>
</div>
