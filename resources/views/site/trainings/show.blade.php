@extends('site.inner')

@section('title')
{!! $training->name !!}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('trainings')}}">{{label('lbl_trainings')}}</a></li>
<li class="breadcrumb-item active" aria-current="page">{!! str_limit(strip_tags($training->title) ,20) !!}</li>
@endsection

{{-- @section('page_title')
{!! $training->name !!}
@endsection --}}

@section('page_content')

<div class="about-page main-container container-fluid bg-white">
    <div class="col-12">
    
        <div class="row">
            <div class="col-lg-8 px-0 my-1 pr-lg-5 page-content">

                <div class="row mx-0 has-shifting-underline">
                    <div class="col-12  px-0">
                        <h5 class="pb-2 position-relative page-title text-uppercase text-primary hover-text-primary"> 
							<span class="d-inline-block py-2 position-relative text-bold text-primary">
							  <span class="px-2222">{!! $training->title !!}</span>
							</span>
							<div class="d-flex w-100 position-absolute bottom-left">
							<div class="shifting-underline-1 padding-1 bg-secondary"></div>
							<div class="shifting-underline-2 padding-1 bg-primary"></div>
							</div>
						  </h5> 
					</div>
                        
                    <div class="col-12  border-bottom-faded">
                        <div class="py-3">
                            @if($training->start_date)
                                <span class="text-muted bold-600 d-inline-block mr-3 ">
                                    <i class="fa fa-calendar-alt mr-1"></i> {!! date('d M, Y', strtotime($training->created_at)) !!}
                                </span>
                            @endif
                            @if($training->end_date) -
                                <span class="text-muted bold-600 d-inline-block ml-2">
                                 <i class="fa fa-calendar-alt mx-1"></i> {!! date('d M, Y', strtotime($training->end_date)) !!}
                                </span>
                            @endif
                            @if($training->location)
                                <span class="px-2 faded">|</span>
                                <span class="">
                                 <i class="fa text-muted  fa-map-marker-alt pr-3"></i>{{$training->location}} 
                                </span>
                            @endif
                            @if($training->file)
                                <span class="px-2 faded">|</span>
                                <a class=" p-2 px-3 box-shadow-slight rounded-slight bg-primary text-white" 
                                 target="_blank" href="{{asset($training->file)}}">
                                 <i class="fa  fa-paperclip pr-3"></i>{{label('lbl_attachment')}} 
                                </a>
                            @endif
                            {{-- <a href="#" target="_blank" rel="noopener noreferrer" class="text-primary d-inline-block">
                                <i class="fa fa-file-download mr-1"></i> DOWNLOAD
                            </a> --}}
                        </div>
                    </div>
                    <div class="col-12 border-top-faded px-0">
                        <div class="rich-text py-3 mt-3">
                            {!! $training->content !!}
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
