<div class="col-12">
    @if($errors->count())
      <div class="alert alert-warning col-12" role="alert">
        <span class='form_error'>{!! $errors->first('keywords_sw') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('keywords_en') !!}</span> <br />
        <span class='form_error'>{!! $errors->first('content_sw') !!}</span>
        <span class='form_error'>{!! $errors->first('content_en') !!}</span>
      </div>
    @endif
</div>

<div class="col-md-12 px-0 mt-0">
  <div class="card-body px-0 pt-0">
    <div class="row">
      <div class="col-md-12 form-group">
        {!! Form::label('keywords_sw', 'keywords in Swahili') !!}
        {!! Form::text('keywords_sw',null,['class'=>'form-control','data-role'=>"tagsinput"]) !!}
        <small class="text-muted">Separate keywords By Comma</small>
      </div>
      <div class="col-md-12 form-group">
        {!! Form::label('keywords_en', 'keywords in English') !!}
        {!! Form::text('keywords_en',null,['class'=>'form-control','data-role'=>"tagsinput"]) !!}
        <small class="text-muted">Separate keywords By Comma</small>
      </div>
      <div class="col-md-12 form-group">
        {!! Form::label('content_sw', 'Contents in Swahili') !!}
        {!! Form::textarea('content_sw',null,['class'=>'form-control','rows'=>'5']) !!}
      </div>
      <div class="col-md-12 form-group">
        {!! Form::label('content_en', 'Contents in English') !!}
        {!! Form::textarea('content_en',null,['class'=>'form-control','rows'=>'5']) !!}
      </div>


      <div class="col-md-12 form-group">
        <h5>Google Form reCAPTCHA Keys</h5>
      </div>

      <div class="col-md-12 form-group">
        {!! Form::label('recaptcha_site_key', 'reCAPTCHA Site Key') !!}
        {!! Form::text('recaptcha_site_key',null,['class'=>'form-control']) !!}
      </div>

      <div class="col-md-12 form-group">
        {!! Form::label('recaptcha_secret_key', 'reCAPTCHA Secret Key') !!}
        {!! Form::text('recaptcha_secret_key',null,['class'=>'form-control']) !!}
      </div>
    </div>

      <div class="col-12 mt-2">
        {!! Form::submit($submittitle, ['class' => 'btn btn-primary col-md-4 offset-md-4']) !!}
      </div>
  </div>
</div>
