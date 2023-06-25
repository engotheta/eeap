<div class="col-12">
    @if($errors->count())
      <div class="alert alert-warning col-12" role="alert">
        <span class='form_error'>{!! $errors->first('title_en') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('title_sw') !!}</span> <br />
				<span class='form_error'>{!! $errors->first('content_en') !!}</span> <br>
				<span class='form_error'>{!! $errors->first('content_sw') !!}</span><br>
				<span class='form_error'>{!! $errors->first('page_category_id') !!}</span>

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
				{!! Form::label('content_sw', 'Swahili Content') !!}
				{!! Form::textarea('content_sw',null, ['id' => 'redactor_sw','class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
				{!! Form::label('content_en', 'English Content') !!}
				{!! Form::textarea('content_en',null, ['id' => 'redactor_sw','class'=>'form-control']) !!}
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
