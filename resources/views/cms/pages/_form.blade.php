<div class="col-12">
    @if($errors->count())
      <div class="alert alert-warning col-12" role="alert">
        <span class='form_error'>{!! $errors->first('title_en') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('title_sw') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('banner_sw') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('banner_en') !!}</span> <br />       
				<span class='form_error'>{!! $errors->first('content_en') !!}</span> <br>
				<span class='form_error'>{!! $errors->first('content_sw') !!}</span><br>
				<span class='form_error'>{!! $errors->first('page_category_id') !!}</span>
        <span class='form_error'>{!! $errors->first('banner_img') !!}</span> <br />

      </div>
    @endif
</div>

<div class="col-md-12 px-0 mt-0">
  {{-- photo upload --}}
  <div class="card-body px-0 pt-0">
    <div class="row">
    
      {{-- <div class="form-group">
          {!! Form::label('banner_img', ' ') !!}
          {!! Form::hidden('banner_img', null,['id' => 'upload_img','class'=>'form-control']) !!}
      </div> --}}

      {{-- <div class="col-12 form-group">
        {!! Form::label('banner_en', 'Banner content in in English') !!}
        {!! Form::text('banner_en',null,['class'=>'form-control']) !!}
      </div> --}}

      {{-- <div class="col-12 form-group">
        {!! Form::label('banner_sw', 'Banner content in  Swahili') !!}
				{!! Form::text('banner_sw',null,['class'=>'form-control']) !!}
      </div> --}}

      <div class="col-12 form-group">
        {!! Form::label('title_en', 'Title in  english *') !!}
				{!! Form::text('title_en',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('title_sw', 'Title in in swahili *') !!}
        {!! Form::text('title_sw',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
				{!! Form::label('has_sidebar', 'Page Has Left SideBar? *') !!}
				{!! Form::select('has_sidebar', array('1' => 'YES, Display Left SideBar','0'=>'NO, Don\'t display Left SideBar'), null, array('class' => 'form-control')) !!}
      </div>

      <div class="col-12 form-group">
				{!! Form::label('content_en', 'English Content *') !!}
				{!! Form::textarea('content_en',null, ['id' => 'redactor_en','class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
				{!! Form::label('content_sw', 'Swahili Content *') !!}
				{!! Form::textarea('content_sw',null, ['id' => 'redactor_sw','class'=>'form-control']) !!}
      </div>

    

{{--      <div class="col-6 form-group">--}}
{{--				{!! Form::label('page_category_id', 'Category') !!}--}}
{{--				{!! Form::select('page_category_id', $categories, null, array('class' => 'form-control')) !!}--}}
{{--      </div>--}}

      <div class="col-12 form-group">
        {!! Form::submit($submitButton, ['class' => 'btn btn-primary col-md-6 offset-md-3']) !!}
      </div>
    </div>
  </div>
</div>
