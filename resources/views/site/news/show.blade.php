@extends('site.inner')
@section('title')
{!! $news->title !!}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('news')}}">{{label('lbl_news')}}</a></li>
<li class="breadcrumb-item active" aria-current="page">{!! str_limit(strip_tags($news->title) ,20) !!}</li>
@endsection

{{-- @section('page_title')
{!! $news->title  !!}
@endsection --}}

@section('page_content')

<div class="about-page  main-container container-fluid bg-white">
    <div class="col-12">
        
        <div class="col-12 py-3">
            <div class="row">
                <div class="col-lg-12 page-content my-2">

                    <div class="row pr-md-5 has-content-title">
                        <div class="col-12 py-1 px-0">
                            <h5 class="text-left content-title py-4 mb-4 font-20">{!! $news->title !!}</h5>
                        </div>
                        <div class="col-12 px-0 py-3 border-bottom">
                            <div class="row mx-0">
                                <span class="pr-3 bold-600 d-inline-block">
                                    <span class="fa fa-calendar mr-1"></span> 
                                    {!! date('d M, Y', strtotime($news->created_at)) !!}
                                </span>
                            </div>
                        </div>
                        <div class="col-12 px-0 mt-2">
                            <div class="py-2">
                                <img class="img-fluid" src="{{asset('uploads/news/'.$news->photo_url)}}" alt="{{$news->title}}">
                            </div>
                            <div class="rich-text py-2">
                                {!! $news->content !!}
                            </div>
                        </div>
                        
                    </div>

                </div>
                {{-- <div class="col-lg-4 px-0 mt-2">
                    @include('site.includes/sidebar')
                </div> --}}
            </div>
        </div>

    </div>

</div>

@stop