@extends('site.inner')

@section('title')
{!! $stakeholder->name !!}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('stakeholders/'.$category->slug)}}">{{$category->title}}</a></li>
<li class="breadcrumb-item active" aria-current="page">{!! str_limit(strip_tags($stakeholder->title) ,20) !!}</li>
@endsection

{{-- @section('page_title')
{!! $stakeholder->name !!}
@endsection --}}

@section('page_content')

<div class="about-page main-container container-fluid bg-white">
    <div class="col-12">
    
        <div class="row">
            <div class="col-lg-8 px-0 my-2 pr-lg-5 page-content">

                <div class="row mx-0 has-shifting-underline">
                    <div class="col-12 py-1 px-0 ">
                        <h5 class="pb-2 position-relative page-title text-uppercase text-primary hover-text-primary"> 
							<span class="d-inline-block py-2 position-relative text-bold text-primary">
							  <span class="px-2222"> {!! $stakeholder->title !!}</span>
							</span>
							<div class="d-flex w-100 position-absolute bottom-left">
							<div class="shifting-underline-1 padding-1 bg-secondary"></div>
							<div class="shifting-underline-2 padding-1 bg-primary"></div>
							</div>
						  </h5>   
					</div>
                  
                    <div class="col-12 px-0 mt-2 border-bottom">
                        <div class="py-2  text-center">
                            <img class="img-fluid" style="max-width:300px" src="{{asset('uploads/stakeholders/'.$stakeholder->photo_url)}}" alt="{{$stakeholder->title}}">
                        </div>
                        <div class="rich-text py-2">
                            {!! $stakeholder->content !!}
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
