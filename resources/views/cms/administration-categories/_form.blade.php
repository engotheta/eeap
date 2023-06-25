<div class="col-12">
    @if($errors->count())
      <div class="alert alert-warning col-12" role="alert">
        <span class='form_error'>{!! $errors->first('title_sw') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('title_en') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('url') !!}</span>
      </div>
    @endif
</div>

<div class="col-md-12 px-0 mt-0">
  <div class="card-body px-0 pt-0">
    <div class="row">
      <div class="col-12 form-group">
        {!! Form::label('title_sw', 'Category title  in swahili *') !!}
        {!! Form::text('title_sw',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('title_en', 'Category title in  english *') !!}
				{!! Form::text('title_en',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('summary_sw', 'Summary of the Category in Swahili') !!}
				{!! Form::textarea('summary_sw',null,['class'=>'form-control', 'row'=>'2']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('summary_en', 'Summary of the Category in English') !!}
				{!! Form::textarea('summary_en',null,['class'=>'form-control', 'row'=>'2']) !!}
      </div>

      <?php $default = isset($category)? $category->featured: null ?>
      <div class="col-12 form-group">
        {!! Form::label('featured', 'Show on Homepage as TIRA Leadership') !!}
        {!! Form::select('featured', array(0 =>'NO',1 => 'YES'), $default, array('class' => 'form-control')) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::submit($submitButton, ['class' => 'btn btn-primary col-md-12']) !!}
      </div>
    </div>
  </div>
</div>
