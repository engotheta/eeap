@extends('site.layout')

@section('content')

  <div class="pages-decorater-top bg-gradient-secondary-transparent position-relative">
    <div id="particles-js" class="h-100 w-100 top-left position-absolute"></div>
    <div class="h-100 w-100 top-left bg-gradient-primary-transparent position-absolute" style="opacity: 0.3"></div>
    
    <div class="container-fluid px-lg-5 breadcumb-banner 
     h-100 w-100 top-left position-absolute  parallax-banner faded-banner"  
     @if($background) style="background-image:url({{asset($background->main_bg)}}); 
     background-repeat: no-repeat; background-size: cover;" @endif
     data-offset="270px" data-rate="0.3">
    </div>

   
  </div>

  <div class="about-page main-container container pages-decorater-bottom rounded-0 bg-white p-md-4 ">
    <div class="container breadcumb-banner small">
      <ol class="breadcrumb fa bg-transparent text-dark bold-600 mb-0">
        <li class="breadcrumb-item"><a href="{{ url('/') }}"><span class="fas fa-home d-none"></span></a>Home</li>
        @yield('breadcrumb')
      </ol>
    </div>

    @yield('page_content')
  </div>

@stop
