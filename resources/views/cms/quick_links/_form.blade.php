@php
    $radio_catch_id = (isset($link))? $link->id : 0;
@endphp
<div class="col-12">
    @if($errors->count())
      <div class="alert alert-warning col-12" role="alert">
        <span class='form_error'>{!! $errors->first('title_en') !!}</span> <br />
  	    <span class='form_error'>{!! $errors->first('title_sw') !!}</span> <br />
  		  <span class='form_error'>{!! $errors->first('url') !!}</span>
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
				{!! Form::radio('link', 1, true, array('class' => 'int_link quick-link', 'id' => 'int_link'.$radio_catch_id, 'data-target' => $radio_catch_id)) !!}
				{!! Form::label('int_link'.$radio_catch_id, 'Internal link') !!}
        
        {!! Form::radio('link', 0, false, array('class' => 'ext_link quick-link', 'id' => 'ext_link'.$radio_catch_id, 'data-target' => $radio_catch_id)) !!}
        {!! Form::label('ext_link'.$radio_catch_id, 'External link') !!}
      </div>

      <div class="col-12 form-group external external{{$radio_catch_id}}">
        {!! Form::label('url', "External Link / URL *") !!}
        {!! Form::input('url', 'url_external', null, array('class'=>'form-control')) !!}
      </div>

      <div class="col-12 form-group internal internal{{$radio_catch_id}}">
        {!! Form::label('url', "internal Link/URL *") !!}
        {!! Form::select('url', App\Models\Menu::selectMenu(), null, array('class' => 'form-control'))!!}
      </div>

      <div class="col-12 form-group">
        {!! Form::submit($submitButton, ['class' => 'btn btn-primary col-md-12']) !!}
      </div>
    </div>
  </div>
</div>

