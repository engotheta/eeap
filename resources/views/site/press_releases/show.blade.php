@extends('site.inner')

@section('title')
{!! $press_release->name !!}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('press-releases')}}">{{label('lbl_press')}}</a></li>
<li class="breadcrumb-item active" aria-current="page">{!! str_limit(strip_tags($press_release->name) ,20) !!}</li>
@endsection

{{-- @section('page_title')
{!! $press_release->name !!}
@endsection --}}

@section('page_content')

<div class="about-page main-container container-fluid bg-white">
    <div class="col-12">
    
        <div class="row">
            <div class="col-lg-8 px-0 my-2 pr-lg-5 page-content">

                <div class="row mx-0 has-content-title">
                    <div class="col-12 py-1 px-0">
                        <h5 class="text-left content-title py-4 mb-4 font-20"> {!! $press_release->name !!} </h5>
                    </div>
                        
                    <div class="col-12 mt-3 px-0 border-bottom-faded">
                        <div class="py-3">
                            <span class="text-muted bold-600 d-inline-block mr-4">
                                <i class="fa fa-calendar-alt mr-1"></i> {!! date('d M, Y', strtotime($press_release->created_at)) !!}
                            </span>
                            <a href="{!! asset($press_release->file) !!}" target="_blank" rel="noopener noreferrer" 
                                class="d-inline-block btn btn-outline-primary rounded">
                                <i class="fa fa-file-download mr-1"></i> {{ label('lbl_download') }}
                            </a>
                        </div>
                    </div>
                    <div class="col-12 border-top-faded px-0">
                        <div class="rich-text py-3 mt-3">
                            {!! $press_release->content !!}
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