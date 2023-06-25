<div class="col-12">
    @if($errors->count())
      <div class="alert alert-warning col-12" role="alert">
        <span class='form_error'>{!! $errors->first('member_id') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('title_sw') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('title_en') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('position') !!}</span> <br />
      </div>
    @endif
</div>

<div class="col-md-12 px-0 mt-0">
  <div class="card-body px-0 pt-0">
    <div class="row">

      <div class="col-12 form-group">
        {!! Form::label('member_id', '* Administration Member') !!}
        {!! Form::select('member_id', $administration,null,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('title_en', '* (English) Member\'s Title/Position in '.$category->title) !!}
				{!! Form::text('title_en',null,['class'=>'form-control', 'placeholder' => 'e.g Board Chairman']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('title_sw', '* (Swahili) Member\'s Title/Position in '.$category->title) !!}
        {!! Form::text('title_sw',null,['class'=>'form-control', 'placeholder' => 'e.g Mwenyekiti wa Bodi']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('position', '* Hierarchy Position') !!}
				{!! Form::number('position',null,['class'=>'form-control', 'min' => '1', 'step'=> '1']) !!}
      </div>

      <div class="col-12 form-group" style="display:none">
        {!! Form::label('category_id', 'Program Category') !!}
        {!! Form::text('category_id',$category->id,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::submit($submitButton, ['class' => 'btn btn-primary col-md-12']) !!}
      </div>

    </div>
  </div>
</div>
