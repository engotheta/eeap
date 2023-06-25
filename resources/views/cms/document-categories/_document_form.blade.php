<div class="col-12">
    @if($errors->count())
      <div class="alert alert-warning col-12" role="alert">
        <span class='form_error'>{!! $errors->first('title_en') !!}</span> <br/>
        <span class='form_error'>{!! $errors->first('title_sw') !!}</span> <br/>
        <span class='form_error'>{!! $errors->first('file_en') !!}</span> <br/>
        <span class='form_error'>{!! $errors->first('file_sw') !!}</span> <br/>
        <span class='form_error'>{!! $errors->first('published_date') !!}</span> <br/>
      </div>
    @endif
</div>

<div class="col-md-12 px-0 mt-0">
  {{-- photo upload --}}
  <div class="card-body px-0 pt-0">
    <div class="row">
      <div class="col-12 form-group">
        {!! Form::label('title_sw', 'Title in swahili *') !!}
        {!! Form::text('title_sw',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('title_en', 'Title in  english *') !!}
				{!! Form::text('title_en',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('file_sw', 'File in Swahili (use PDF)') !!}
        {!! Form::file('file_sw',['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('file_en', 'File in English (use PDF)') !!}
        {!! Form::file('file_en',['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group" style="display:none">
        {!! Form::label('category_id', 'Publication Category') !!}
        {!! Form::text('category_id',$category->id,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('active', 'Status') !!}
        {!! Form::select('active', array('1' => 'Active','0'=>'Inactive'),null,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::label('published_date', 'Published Date') !!}
        {!! Form::input('date', 'published_date',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::submit($submitButton, ['class' => 'btn btn-primary col-md-12']) !!}
      </div>
    </div>
  </div>
</div>
