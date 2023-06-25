@extends('site.inner')
@section('title')
{{label('lbl_achievements')}}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">{{label('lbl_achievements')}}</li>
@endsection

{{-- @section('page_title')
{!! $achievement->title  !!}
@endsection --}}

@section('page_content')
<div class="bg-gradient-white-light h-100 w-100 position-absolute top-left"></div>
<div class="about-page main-container container-fluid bg-white">
  <div class="col-12 ">
  
      <div class="row">
          <div class="col-lg-8 px-0 my-2 pr-lg-5 page-content has-shifting-underline">

            <div class="row mx-0">
              <div class="col-12 py-1 px-0">
                <h5 class="pb-2 position-relative page-title text-uppercase text-primary hover-text-primary"> 
                    <span class="d-inline-block py-2 position-relative text-bold text-primary">
                        <span class="px-2222"> {{ label('lbl_achievements') }}</span>
                    </span>
                    <div class="d-flex w-100 position-absolute bottom-left">
                    <div class="shifting-underline-1 padding-1 bg-secondary"></div>
                    <div class="shifting-underline-2 padding-1 bg-primary"></div>
                    </div>
                </h5>   
              </div>

              @if (count($achievements ))
                <div class="row px-0">
                    @foreach ($achievements as $achievement)
                    <div class="col-md-6 col-lg-6 d-flex px-0 px-lg-3 py-2 flex-column justify-content-between">
                      <div class="box-shadow h-100 mb-4 rounded-smallll border-none overflow-hidden  bg-white show-more-content-news">
                        <a href="{{url('/achievements/'.$achievement->slug)}}" class="zoom-container">
                        <div class="overflow-hidden full-hd-container position-relative bg-secondary">
                          <img class="card-img-top image" src="{{asset('uploads/achievements/'.$achievement->photo_url)}}" alt="Card image cap">
                          <div class="dark-overlay"></div>
                        </div>
                        <div class="position-relative h-100">
                          <div class="p-3 px-4 bg-white content text-dark">
                          <div class="">
                            <h6 class="card-text text-muted pb-3 small text-primary">{!! date('d M Y', strtotime($achievement->created_at)) !!} </h6>
                            <h6 class="card-text text-bold">{{str_limit($achievement->title,40)}}</h6>                                    
                          </div>  
                          <div class="card-text px-4 more-content">
                            <div class="text"> {{str_limit(strip_tags($achievement->content),80)}} </div>
                          </div> 
                          </div>                               
                        </div>
                        </a>
                      </div>
                    </div>
                    @endforeach
                </div>

                <div class="col-12 pt-5 pb-3 d-flex justify-content-center">
                  {!! $achievements ->render() !!}
                </div>
              @else
                <div class="col-12 px-0 py-3 bold-600">
                  {{label('lbl_no_information')}}
                </div>
              @endif
            </div>

          </div>
          <div class="col-lg-4 px-0 mt-2">
              @include('site.includes/sidebar')
          </div>
      </div>
      
  </div>
</div>

@stop