@extends('site.layout')
@section('title')

{!! $project->title !!}

@endsection

@section('content')

<div class="breadcumb-banner" > 
    <div class="banner container px-0">    
      <div class="banner-inner px-0">
          <ol class="breadcrumb ">
            <li class="breadcrumb-item "><a href="{{url('/')}}"><span class="fas fa-home"></span></a></li>
            <li class="breadcrumb-item"><a href="{{url('projects')}}">{{label('lbl_projects')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{!! str_limit(strip_tags($project->title) ,20) !!}</li>
            {{-- {{breadcrumb()}} --}}
          </ol>
      </div>
    </div>
</div>

<div class="about-page main-container page-content container bg-white px-3 py-5">
    <div class="col-12 px-0">
        
        <div class="col-12 px-0">
            <div class="row mx-0">
                <div class="col-lg-4 px-0 d-none d-lg-block">
                    @include('site.includes/sidebar')
                </div>
                <div class="col-lg-8 px-0 overflow-hidden">
                    <div class="content-area active row mx-0 position-relative overflow-hidden">
                        <div class="documents-area col-6 px-0 pr-lg-3 pl-lg-5 position-relative">
                            @include('site.includes/documents_area')              
                        </div>
        
                        <div class="main-content-area col-6 px-0 pr-lg-3 pl-lg-5 position-relative">
                            <div class="row mx-0">

                                <div class="w-100">
                                    <h3 class="main-heading"> {{ $project->title }} </h3>
                                    <div class="main-heading-border"></div>
                                </div>
                                
                                <div class="col-12 px-0">

                                    <div class="row mx-0">

                                        {{-- <div class="col-12 px-0 pb-2 d-flex align-items-center bold-600">
                                            <span class="d-inline-block mr-3">
                                                <i class="fa fa-calendar-alt mr-2 text-accent"></i> {!! date('d M, Y', strtotime($project->created_at)) !!}
                                            </span>
                                        </div> --}}
 
                                        <div class="col-12 px-0 mb-3">
                                             <img class="img-fluid" src="{{asset('uploads/projects/'.$project->photo_url)}}" alt="{{$project->title}}">
                                        </div>
 
                                        <div class="col-12 px-0">
                                            <div class="rich-text">
                                                {!! $project->content !!}
                                            </div>
                                        </div>
 
                                    </div>
                                                               
                                </div>

                            </div>
                        </div>
                    </div>
                  
                </div>                
            </div>
        </div>

    </div>

</div>


@stop