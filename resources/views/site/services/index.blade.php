@extends('site.inner')
@section('title')
{{label('lbl_our_services')}}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">{{label('lbl_our_services')}}</li>
@endsection

{{-- @section('page_title')
{!! $service->title  !!}
@endsection --}}

@section('page_content')
<div class="bg-gradient-white-light h-100 w-100 position-absolute top-left"></div>
<div class="about-page main-container container-fluid bg-white">
  <div class="col-12">
  
      <div class="row">
          <div class="col-lg-8 px-0 my-2 pr-lg-5 page-content">


            <div class="row mx-0 has-shifting-underline">
              
              <div class="col-12 py-1 px-0">
                <h5 class="pb-2 position-relative page-title text-uppercase text-primary hover-text-primary"> 
                  <span class="d-inline-block py-2 position-relative text-bold text-primary">
                    <span class="px-2222">{{ label('lbl_our_services') }}</span>
                  </span>
                  <div class="d-flex w-100 position-absolute bottom-left">
                  <div class="shifting-underline-1 padding-1 bg-secondary"></div>
                  <div class="shifting-underline-2 padding-1 bg-primary"></div>
                  </div>
                </h5>  
              </div>
              
              @if (count($services ))
                <div class="col-12 mt-4 px-0">
                    @foreach ($services as $service)
                      <a  href="{{ url('services/'.$service->slug) }}"
                         class="d-block mb-3 zoom-container bg-white show-more-content-news has-hover-bounce box-shadow-slight position-relative">
                          <div class="d-md-flex position-relative">
                            <div class="col-md-3 px-0 full-hd-container mx-auto position-relative" style="min-height: 100px;">
                              <div class="h-100 w-100 image"  style="background-image:url({{asset('uploads/services/'.$service->photo_url)}});
                                background-position:center;background-size:cover; background-repeat:no-repeat;
                                max-widthhh:200px"
                                 ></div>
                              <div class="dark-overlay"></div>
                              <div class="position-absolute top-left h-100 w-100 bg-primary" style="opacity:0.6"></div>
                              <div class="position-absolute top-left h-100 w-100 d-flex justify-content-center align-items-center" >
                                <img src="{{asset('uploads/services/'.$service->icon)}}" 
                                 class="hover-bounce mx-auot white-icon" style="width: 40px; height:auto">
                              </div>
                            </div>
                            <div class="col mt-md-0 mt-3 text-md-left text-center media-body d-flex align-items-center">
                              <div class="p-3 p-md-1">
                                  <h6 class="text-bold text-primary">{{ $service->title }}</h6>
                                  <div class="mt-3 text-dark">{{ str_limit(strip_tags($service->content),80)}}</div>
                              </div>               
                            </div>
                          </div>
                      </a>
                    @endforeach
                </div>

                <div class="col-12 pt-5 pb-3 d-flex justify-content-center">
                  {!! $services ->render() !!}
                </div>
              @else
                <div class="col-12 px-0 py-3 bold-600">
                  {{label('lbl_no_information')}}
                </div>
              @endif
            </div>

          </div>
          <div class="col-lg-4 px-0">
              @include('site.includes/sidebar')
          </div>
      </div>
      
  </div>
</div>

@stop