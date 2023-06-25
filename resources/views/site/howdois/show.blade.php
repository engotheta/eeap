@extends('site.inner')

@section('title')
{!! $howdoi->title !!}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('howdois')}}">{{label('lbl_how_doi')}}</a></li>
<li class="breadcrumb-item active" aria-current="page">{!! str_limit(strip_tags($howdoi->title) ,20) !!}</li>
@endsection

{{-- @section('page_title')
{!! $howdoi->title !!}
@endsection --}}

@section('page_content')

<div class="about-page main-container container-fluid bg-white">
    <div class="col-12">
    
        <div class="row mx-0">
            <div class="col-lg-8 px-0 my-2 pr-lg-5 page-content">

                <div class="row mx-0 has-shifting-underline">

                    <div class="col-12 py-1 px-0 ">
                        <h5 class="pb-2 position-relative page-title text-uppercase text-primary hover-text-primary"> 
							<span class="d-inline-block py-2 position-relative text-bold text-primary">
							  <span class="px-2222">  {!! $howdoi->title !!}</span>
							</span>
							<div class="d-flex w-100 position-absolute bottom-left">
							<div class="shifting-underline-1 padding-1 bg-secondary"></div>
							<div class="shifting-underline-2 padding-1 bg-primary"></div>
							</div>
						</h5>
					</div>
                        
                    <div class="col-12 px-0 border-bottom-faded ">
                        <div class="py-3">
                            <span class="text-muted text-sm bold-600 d-inline-block mr-4">
                                <i class="fa fa-calendar-alt mr-1"></i> {!! label('lbl_posted').': '.date('d M, Y', strtotime($howdoi->created_at)) !!}
                            </span>
                        </div>
                    </div>
                    <div class="col-12 border-top-faded px-0">
                        <div class="rich-text py-3 mt-3">
                            {!! $howdoi->content !!}
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
