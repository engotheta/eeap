@extends('site.inner')
@section('title')
{!! $quote->title !!}
@endsection

@section('breadcrumb')
{{-- <li class="breadcrumb-item"><a href="{{url('quote')}}">{{label('lbl_quote')}}</a></li> --}}
<li class="breadcrumb-item active" aria-current="page">{!! str_limit(strip_tags($quote->title) ,20) !!}</li>
@endsection

{{-- @section('page_title')
{!! $quote->title  !!}
@endsection --}}

@section('page_content')

<div class="about-page  main-container container-fluid bg-white">
    <div class="col-12">
        
        <div class="col-12 py-3">
            <div class="row">
                <div class="col-lg-8 page-content my-2">

                    <div class="row pr-md-5">

                        <div class="col-12 d-md-flex flex-columnnn  align-items-center py-1 px-0 border-bottom-faded">
                            <div class="square-container round background-image box-shadow border"style="width:200px;
                            background-image:url('{{asset('uploads/quotes/'.$quote->photo_url)}}')" > </div>
                            <h5 class="pl-3  text-uppercase "> 
                              <div class="d-block  py-1 lines position-relative">
                                <div class="pr-sm-2 py-1 text-primary  position-relative"> 
                                <span class="border-left-primary text-dark h-100 d-inline-block pl-1 ">
                                  <span class="border-left-secondary-thick  h-100 d-inline-block pl-2 "> {!! $quote->title !!}</span> 
                                </span>
                                </div>
                              </div>                
                            </h5>   
                        </div>

                        {{-- <div class="col-12 px-0 py-3 border-bottom">
                            <div class="row mx-0">
                                <span class="pr-3 bold-600 d-inline-block">
                                    <span class="fa fa-calendar mr-1"></span> 
                                    {!! date('d M, Y', strtotime($quote->created_at)) !!}
                                </span>
                            </div>
                        </div> --}}
                        <div class="col-12 px-0 mt-2">
                            <div class="py-2">
                                <img class="img-fluid" src="{{asset('uploads/quote/'.$quote->photo_url)}}" alt="{{$quote->title}}">
                            </div>
                            <div class="rich-text py-2">
                                {!! $quote->content !!}
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

</div>

@stop