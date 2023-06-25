<div class="col-12">
    @if($errors->count())
      <div class="alert alert-warning col-12" role="alert">
        <span class='form_error'>{!! $errors->first('office_id') !!}</span> <br>
        <span class='form_error'>{!! $errors->first('url') !!}</span>
      </div>
    @endif
</div>

<div class="col-md-12 px-0 mt-0">
  <div class="card-body px-0 pt-0">
    <div class="row">

      <div class="col-12 form-group">
        {!! Form::label('office_id', 'The Regional Office') !!}
        {{-- {!! Form::select('office_id', $offices, null, array('class' => 'form-control select2')) !!} --}}
        <select name="office_id" class="form-control select2">
         @foreach($regional_offices as $office) <option value="{{$office->id}}" 
          @if(isset($google_map) && $google_map->office_id == $office->id) selected @endif>{{$office->name}}</option> @endforeach
        </select>
      </div>

      <div class="col-12 form-group">
        {!! Form::label('url', "Google Map Embeded Iframe *") !!}
				{!! Form::text('url', null, array('required' => 'required','class'=>'form-control')) !!}
      </div>

      <div class="col-12 form-group">
        {!! Form::submit($submitButton, ['class' => 'btn btn-primary col-md-6']) !!}
      </div>
    </div>
  </div>
</div>
