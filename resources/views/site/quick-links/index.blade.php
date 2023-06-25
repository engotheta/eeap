@extends('site.inner')
@section('title')
{!! label('lbl_quick_links') !!}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">{!! label('lbl_quick_links') !!}</li>
@endsection

{{-- @section('page_title')
{!! label('lbl_quick_links') !!}
@endsection --}}

@section('page_content')
<div class="about-page main-container container-fluid bg-white">
    <div class="col-12 pt-3">
    
        <div class="row">
            <div class="col-lg-8 px-0 my-2 pr-lg-5 page-content">

                <div class="row mx-0">

                    <div class="col-12 py-1 px-0 border-bottom-faded">
                        <h5 class="pl-0  text-uppercase "> 
                          <div class="d-block  py-1 lines position-relative">
                            <div class="pr-sm-2 py-1 text-primary  position-relative"> 
                            <span class="border-left-primary text-dark  pl-1 ">
                              <span class="border-left-secondary-thick pl-2 ">{{  label('lbl_quick_links') }} </span> 
                            </span>
                            </div>
                          </div>                
                        </h5>   
                      </div>
                        
                    <div class="col-12 px-0 mt-2">
                        @if(count($links))
                            <div class="py-5 px-3 bg-light-darker">
                                @foreach($links as $link)
                                    <div class="col px-0 pb-1">  
                                        <div class="d-flex align-items-center rounded-slight  hover-bg-trans h-100 w-100 p-2 pointer-hover position-relative">                                    
                                            <a href="{{url($link->url)}}" @if($link->link == 0) target="_blank" rel="noopener noreferrer" @endif class="d-flex w-100 list-item  align-items-center text-bold text-primary text-uppercase">
                                                <i class="fa  text-md fa-hand-point-right px-2 pr-3 align-self-center"></i>
                                                <i class="fa text-md fa-external-link-alt px-2 pr-3  align-self-center"></i>
                                                <span class="d-inline-block">
                                                    <div> {{ $link->title }} </div>                        
                                                </span>   
                                            </a>                
                                        </div>
                                    </div>                
                                @endforeach

                                {{-- <div class="col-12 px-0 pt-5 d-flex justify-content-center">
                                    {!! $links->render() !!}
                                </div> --}}
                            </div>
                        @else
                            <div class="col-12 px-0 text-muted bold-600">
                                {!! label('lbl_no_information') !!}
                            </div>
                        @endif
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
