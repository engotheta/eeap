@extends('site.inner')

@section('title')
{!! label('lbl_feedback') !!}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">{{ label('lbl_feedback') }}</li>
@endsection

{{-- @section('page_title')
{!! label('lbl_feedback') !!}
@endsection --}}

@section('page_content')

<div class="about-page  main-container container-fluid bg-white">

    <div class="col-12 py-3 has-shifting-underline">
        <div class="row">
            <div class="col-12 py-1 px-0 ">
                <h5 class="pb-2 position-relative page-title text-uppercase text-primary hover-text-primary"> 
                    <span class="d-inline-block py-2 position-relative text-bold text-primary">
                      <span class="px-2222">  {!! label('lbl_feedback') !!} </span>
                    </span>
                    <div class="d-flex w-100 position-absolute bottom-left">
                    <div class="shifting-underline-1 padding-1 bg-secondary"></div>
                    <div class="shifting-underline-2 padding-1 bg-primary"></div>
                    </div>
                </h5>     
            </div>
            <div class="col-12 page-content my-2">
                <div class="row pr-md-5">
                    <div class="col-12 px-0 mt-2">
                        <div class="row mx-0">
                            <div class="col-12 px-0">                             
                                <div class="container custom-form mt-lg-3 px-0" style="max-width: 1024px;">
                                    <h5 class="px-3 py-2 text-secondary"><i class="fa fa-reply pr-2 d-none"></i> {!! label('lbl_details') !!} </h5>
                                    @if(session('status') == 'success')
                                        <div class="d-block p-3">
                                            <div class="alert alert-success fade show py-5 text-center" role="alert">
                                                <strong> <h5 class="bold-600">{{ label('lbl_feedback_success') }}</h5> </strong>
                                            </div>
                                        </div>
                                    @else
                                        @if(!empty($seo->recaptcha_site_key) && !empty($seo->recaptcha_secret_key))
                                            <form class="card-form px-3" method="POST" action="{{route('complaints.store')}}" autocomplete="off" accept-charset="UTF-8">
                                                {{ csrf_field() }}

                                                <div class="d-flex align-items-center">
                                                    <i class="label fa fa-user pr-2"> </i>
                                                    <div class="col input">
                                                        <input required value="{{ old('first_name') }}" type="text" name="first_name" class="input-field" id="first_name">
                                                        <label for="first_name" class="input-label">* {{label('lbl_fullname')}}</label>
                                                    </div>
                                                </div>
                                                <div class="ml-5 mb-3"><span class='form_error' style="color:red;">{!! $errors->first('first_name') !!}</span></div>

                                                <div class="d-flex align-items-center">
                                                    <i class="label fa fa-paper-plane pr-2"> </i>
                                                    <div class="col input">
                                                        <input required value="{{ old('email') }}" type="email" name="email" class="input-field" id="email">
                                                        <label for="email" class="input-label">* {{label('lbl_email')}}</label>
                                                    </div>
                                                </div>
                                                <div class="ml-5 mb-3"><span class='form_error' style="color:red;">{!! $errors->first('email') !!}</span></div>

                                                <div class="d-flex align-items-center">
                                                    <i class="label fa fa-phone pr-2 mt-2"></i>
                                                    <div class="col input">
                                                        <input required value="{{ old('phone') }}" type="text" name="phone" class="input-field" id="phone">
                                                        <label for="phone" class="input-label">* {{label('lbl_phone_number')}}</label>
                                                    </div>
                                                </div>
                                                <div class="ml-5 mb-3"><span class='form_error' style="color:red;">{!! $errors->first('phone') !!}</span></div>

                                                <div class="d-flex align-items-center">
                                                    <i class="label fa fa-building pr-2 mt-2"></i>
                                                    <div class="col input">
                                                        <input value="{{ old('organization') }}" type="text" name="organization" class="input-field" id="organization">
                                                        <label for="organization" class="input-label">{{label('lbl_organization')}}</label>
                                                    </div>
                                                </div>
                                                <div class="ml-5 mb-3"><span class='form_error' style="color:red;">{!! $errors->first('organization') !!}</span></div>
                                                
                                                <div class="d-flex align-items-center">
                                                    <i class="label fa fa-comment-alt pr-2 mt-2"></i>
                                                    <div class="col input">
                                                        <input required value="{{ old('subject') }}" type="text" name="subject" class="input-field" id="subject">
                                                        <label for="subject" class="input-label">* {{label('lbl_subject')}}</label>
                                                    </div>
                                                </div>
                                                <div class="ml-5 mb-3"><span class='form_error' style="color:red;">{!! $errors->first('subject') !!}</span></div>
                                                
                                                <div class="d-flex align-items-center">
                                                    <i class="label fa fa-comments pr-2"></i>
                                                    <div class="col input">
                                                        <textarea required name="message" id="message" class="input-field">{{ old('message') }}</textarea>
                                                        <label for="message" class="input-label">* {{label('lbl_message')}}</label>
                                                    </div>
                                                </div>
                                                <div class="ml-5 mb-3"><span class='form_error' style="color:red;">{!! $errors->first('message') !!}</span></div>
                                                
                                                {{-- <div class="d-block mb-3 ml-sm-5">
                                                    <div class="g-recaptcha"
                                                        data-sitekey="{{$seo->recaptcha_site_key}}">
                                                    </div>
                                                    <div class="mt-1"><span class='form_error' style="color:red;">{!! $errors->first('g-recaptcha-response') !!}</span></div>
                                                </div> --}}

                                                <div class="action mb-4 ml-sm-5">
                                                    <button type="submit" class="action-button btn bg-primary text-white px-3 py-2">{{label('lbl_submit')}} {!! label('lbl_feedbacks') !!}</button>
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

@stop

@section('js-content')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@stop