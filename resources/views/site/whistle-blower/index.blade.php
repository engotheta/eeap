@extends('site.inner')

@section('title')
{!! label('lbl_whistle_blower') !!}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">{{ label('lbl_whistle_blower') }}</li>
@endsection

{{-- @section('page_title')
{!! label('lbl_whistle_blower') !!}
@endsection --}}

@section('page_content')

<div class="about-page  main-container container-fluid bg-white">
    <div class="col-12">
        <div class="col-12 py-3">
            <div class="row">
                <div class="col-12 page-content my-2">
                    <div class="row pr-md-5">
                        <div class="col-12 px-0 mt-2">
                            <div class="row mx-0">
                                <div class="col-12 px-0">                             
                                    <div class="container custom-form border box-shadow rounded-medium mt-lg-3 px-0" style="max-width: 1024px;">
                                        <h5 class="bg-primary drafted px-3 py-2 text-secondary"><i class="fa fa-reply pr-2 "></i> {!! label('lbl_whistle_blower') !!} </h5>
                                        @if(session('status') == 'success')
                                            <div class="d-block p-3">
                                                <div class="alert alert-success fade show py-5 text-center text-uppercase" role="alert">
                                                    <strong> <h5 class="bold-600">{{ label('lbl_whistle_blower_success') }}</h5> </strong>
                                                </div>
                                            </div>
                                        @else
                                            @if(!empty($seo->recaptcha_site_key) && !empty($seo->recaptcha_secret_key))
                                                @if(session('status') == 'fail')
                                                    <div class="d-block p-3">
                                                        <div class="alert alert-danger fade show py-3 text-center text-uppercase" role="alert">
                                                            <strong> <h4 class="bold-600">{{ label('lbl_whistle_blower_fail') }}</h4> </strong>
                                                        </div>
                                                    </div>
                                                @endif

                                                <form class="card-form px-3 px-sm-5" method="POST" action="{{route('whistle-blower.store')}}" autocomplete="off" enctype="multipart/form-data" accept-charset="UTF-8">
                                                    {{ csrf_field() }}

                                                    <div class="d-flex align-items-center">
                                                        <i class="label fa fa-user pr-2"> </i>
                                                        <div class="col input">
                                                            <input value="{{ old('fullname') }}" type="text" name="fullname" class="input-field" id="fullname">
                                                            <label for="fullname" class="input-label">{{label('lbl_fullname')}} ({{label('lbl_optional')}})</label>
                                                        </div>
                                                    </div>
                                                    <div class="ml-5 mb-3"><span class='form_error' style="color:red;">{!! $errors->first('fullname') !!}</span></div>

                                                    <div class="d-flex align-items-center">
                                                        <i class="label fa fa-paper-plane pr-2"> </i>
                                                        <div class="col input">
                                                            <input value="{{ old('email') }}" type="email" name="email" class="input-field" id="email">
                                                            <label for="email" class="input-label">{{label('lbl_email')}} ({{label('lbl_optional')}})</label>
                                                        </div>
                                                    </div>
                                                    <div class="ml-5 mb-3"><span class='form_error' style="color:red;">{!! $errors->first('email') !!}</span></div>

                                                    <div class="d-flex align-items-center">
                                                        <i class="label fa fa-phone pr-2 mt-2"></i>
                                                        <div class="col input">
                                                            <input value="{{ old('phone') }}" type="text" name="phone" class="input-field" id="phone">
                                                            <label for="phone" class="input-label">{{label('lbl_phone_number')}} ({{label('lbl_optional')}})</label>
                                                        </div>
                                                    </div>
                                                    <div class="ml-5 mb-3"><span class='form_error' style="color:red;">{!! $errors->first('phone') !!}</span></div>

                                                    <div class="d-flex align-items-center">
                                                        <i class="label fa fa-map-marker-alt pr-2 mt-2"></i>
                                                        <div class="col input">
                                                            <input required value="{{ old('incident_location') }}" type="text" name="incident_location" class="input-field" id="incident_location">
                                                            <label for="incident_location" class="input-label">* {{label('lbl_incident_location')}}</label>
                                                        </div>
                                                    </div>
                                                    <div class="ml-5 mb-3"><span class='form_error' style="color:red;">{!! $errors->first('incident_location') !!}</span></div>
                                                                                                        
                                                    <div class="d-flex align-items-center">
                                                        <i class="label fa fa-comment-dots pr-2"></i>
                                                        <div class="col input">
                                                            <textarea required rows="2" name="incident_description" id="incident_description" class="input-field">{{ old('incident_description') }}</textarea>
                                                            <label for="incident_description" class="input-label">* {{label('lbl_incident_description')}}</label>
                                                        </div>
                                                    </div>
                                                    <div class="ml-5 mb-3"><span class='form_error' style="color:red;">{!! $errors->first('incident_description') !!}</span></div>
                                                    
                                                    <div class="d-flex align-items-center">
                                                        <i class="label fa fa-info-circle pr-2 mt-2"></i>
                                                        <div class="col input">
                                                            <input value="{{ old('incident_extra_info') }}" type="text" name="incident_extra_info" class="input-field" id="incident_extra_info">
                                                            <label for="incident_extra_info" class="input-label">{{label('lbl_incident_extra_info')}}</label>
                                                        </div>
                                                    </div>
                                                    <div class="ml-5 mb-3"><span class='form_error' style="color:red;">{!! $errors->first('incident_extra_info') !!}</span></div>

                                                    <div class="file-input">
                                                        <label class="w-100 text-center card-info input-file-label d-block" for="attachment">{{label('lbl_attachment_proof')}} ({{label('lbl_optional')}})</label>                                                           
                                                        <span class="fa fa-paperclip btn p-3 text-primary box-shadow rounded bg-light click-bait w-100" data-click="#attachment">
                                                            <span id="fileDisplay" class="px-2"> </span>
                                                        </span>                                                            
                                                        <input hidden value="{{ old('attachment') }}" accept="application/pdf,image/png,image/jpeg" type="file" class="input-field file" data-display="#fileDisplay" name="attachment" id="attachment"/>                                                            
                                                    </div>
                                                    <div class="mb-3 text-center"><span class='form_error' style="color:red;">{!! $errors->first('attachment') !!}</span></div>

                                                    <div class="d-block py-3">
                                                        <div class="g-recaptcha"
                                                            data-sitekey="{{$seo->recaptcha_site_key}}">
                                                        </div>
                                                        <div class="mt-1"><span class='form_error' style="color:red;">{!! $errors->first('g-recaptcha-response') !!}</span></div>
                                                    </div>

                                                    <div class="action mb-4">
                                                        <button type="submit" class="action-button px-3 py-2">{{label('lbl_submit')}} {!! label('lbl_whistle_blower') !!}</button>
                                                    </div>
                                                </form>
                                            @else
                                                <div class="py-5 px-3 bold-600 text-muted">
                                                    {{ label('lbl_no_information') }}
                                                </div>
                                            @endif
                                        @endif
                                    </div>                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('js-content')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@stop