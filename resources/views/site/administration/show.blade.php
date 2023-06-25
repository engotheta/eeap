@extends('site.inner')

@section('title')
	{!! $member->salutation.' '.$member->fullname !!}
@endsection

@section('breadcrumb')
  @if($category)
    <li class="breadcrumb-item"><a href="{{url('administration/'.$category->slug)}}">{{ $category->title }}</a></li>
  @endif
  <li class="breadcrumb-item"><a href="javascript::">{{ label('lbl_biography') }}</a></li>
  <li class="breadcrumb-item active" aria-current="page">{!! str_limit(strip_tags($member->salutation.' '.$member->fullname) ,40) !!}</li>
  {{-- {{breadcrumb()}} --}}
@endsection

{{-- @section('page_title')
  {!! $member->salutation.' '.$member->fullname !!}
@endsection --}}

@section('page_content')

<div class="about-page main-container container-fluid bg-white">
  <div class="col-12">
  
      <div class="row">
          <div class="col-lg-8 px-0 my-2 pr-lg-5 has-shifting-underline page-content">
         
            <div class="row mx-0">

              <div class="col-12 px-0 py-1">
                <h5 class="pb-2 position-relative page-title text-uppercase text-primary hover-text-primary"> 
                  <span class="d-inline-block py-2 position-relative text-bold text-primary">
                      <span class="px-2222">{!! $member->salutation.' '.$member->fullname !!}</span>
                  </span>
                  <div class="d-flex w-100 position-absolute bottom-left">
                  <div class="shifting-underline-1 padding-1 bg-secondary"></div>
                  <div class="shifting-underline-2 padding-1 bg-primary"></div>
                  </div>
                </h5>
              </div>
                    
                <div class="col-12 px-0 mt-2">
                  <div class="col-12 px-0 my-3 text-center border-bottom text-md-left">
                    <div class="row">
                      <div class="col-12 col-md-4 col-lg-3 mb-3">
                        <img class="align-self-center img-fluid mr-3" 
                        style="max-height: 200px !important;"
                        src="{{  url('/uploads/administration/'.$member->photo_url) }}" 
                        alt="{!! $member->fullname !!} photo">
                      </div>
      
                      <div class="col-12 col-md-8 col-lg-9 mb-3 media-body align-self-center">
                        <h5 class="">
                          {{-- {{label('lbl_name')}}:  --}}
                          <span class="text-primary bold-600">{{ $member->salutation.' '.$member->fullname }}</span>
                        </h5>
                        <h5 class="">
                          {{-- {{label('lbl_name')}}:  --}}
                          <span class="text-primary bold-600">{{ $member->title }}</span>
                        </h5>
                        <p class="my-1">
                          <span class="font-weight-bold">{{ label('lbl_email') }}:</span> 
                          <a title="Send Email" href="mailto:{{$member->email}}">{{ $member->email }}</a>
                        </p>
                        <p class="my-1">
                          <span class="font-weight-bold">{{ label('lbl_phone') }}:</span> 
                          <a title="Call" href="tel:{{$member->phone}}">{{ $member->phone }}</a>
                        </p>
                      </div>
                    </div>
                  </div>
      
                  <div class="col-12 px-0 mt-3">
                    <div>
                      <h5 class="other-heading">{{label('lbl_biography')}} </h5>
                    </div>
      
                    @if(!empty($member->content))
                      <div class="rich-text">
                        {!! $member->content !!}
                      </div>
                    @else
                      <div>
                        {{label('lbl_no_information')}}
                      </div>
                    @endif
                  </div>
                </div>
                
            </div>

          </div>
          <div class="col-lg-4 px-0">
              @include('site.includes/sidebar')
          </div>
      </div>
      
  </div>

</div>

@stop

