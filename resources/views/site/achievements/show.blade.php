@extends('site.inner')
@section('title')
{!! $achievement->title !!}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('achievements')}}">{{label('lbl_achievements')}}</a></li>
<li class="breadcrumb-item active" aria-current="page">{!! str_limit(strip_tags($achievement->title) ,20) !!}</li>
@endsection

{{-- @section('page_title')
{!! $achievement->title  !!}
@endsection --}}

@section('page_content')

<div class="about-page  main-container container-fluid bg-white">
    <div class=" ">
        
        <div class="col-12 py-3">
            <div class="row">
                <div class="col-lg-8 page-content my-2 has-shifting-underline">

                    <div class="row pr-md-5">
                        <div class="col-12 py-1 px-0 ">
                            <h5 class="pb-2 position-relative page-title text-uppercase text-primary hover-text-primary"> 
                                <span class="d-inline-block py-2 position-relative text-bold text-primary">
                                    <span class="px-2222">  {!! $achievement->title !!}</span>
                                </span>
                                <div class="d-flex w-100 position-absolute bottom-left">
                                <div class="shifting-underline-1 padding-1 bg-secondary"></div>
                                <div class="shifting-underline-2 padding-1 bg-primary"></div>
                                </div>
                            </h5>  
                        </div>
            
                        <div class="col-12 px-0 mt-2">
                            <div class="rich-text py-2">
                                {!! $achievement->content !!}
                            </div>
                            <div class="py-3 text-center">
                                <img class="img-fluid" src="{{asset('uploads/achievements/'.$achievement->icon)}}" alt="{{$achievement->title}}">
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

</div>

@stop