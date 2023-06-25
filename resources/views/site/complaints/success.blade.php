@extends('site.layout')
@section('title')
  {{ label('lbl_feedback') }}
@endsection
@section('content')

<div class="breadcumb-banner bg-light banner-image-home" @if($background) style="background-image: url({{asset($background->banner_bg)}})" @endif>  
    <div class="banner px-3 px-lg-5 pt-5">    
        <div class="banner-inner px-xl-5 d-flex">
            <ol class="breadcrumb hover-bg-trans bg-primary">
                <li class="breadcrumb-item "><a href="{{url('/')}}"><span class="fas fa-home"></span></a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ label('lbl_feedback') }}</li>
            </ol>
        </div>
    </div>
</div>

<div class="about-page main-container container-fluid p-3 p-lg-5 bg-white">
    <div class="col-12 px-0 px-xl-5 pt-3">
    
        <div class="row mx-0">
            <div class="col-lg-8 px-0 my-2 pr-lg-5 page-content has-shifting-underline">

                <div class="row mx-0">
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
                        
                    <div class="col-12 px-0 mt-2">
                        <div class="rich-text c-green bold-600 pb-3">
                            <h3>{{ label('lbL_feedback_success')}}!</h3>
                        </div>
                    </div>
                    
                </div>

            </div>
            <div class="col-lg-4 px-0 mt-2">
                @include('site.includes/sidebar')
            </div>
        </div>
        
    </div>

</div>

@stop

