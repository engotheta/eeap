@extends('site.inner')

@section('title')
{{ label('lbl_dg_message') }}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">{{label('lbl_dg_message')}}</li>
@endsection

{{-- @section('page_title')
{{ label('lbl_welcome_note') }}
@endsection --}}

@section('page_content')

<div class="about-page main-container container-fluid bg-white">
    <div class="col-12 ">

        <div class="row mx-0">
            <div class="col-lg-12 px-0 my-2 pr-lg-5 page-content has-shifting-underline">

                <div class="col-12 py-1 px-0 ">
                    <h5 class="pb-2 position-relative page-title text-uppercase text-primary hover-text-primary"> 
                        <span class="d-inline-block py-2 position-relative text-bold text-primary">
                          <span class="px-2222">  {!! label('lbl_dg_message') !!} </span>
                        </span>
                        <div class="d-flex w-100 position-absolute bottom-left">
                        <div class="shifting-underline-1 padding-1 bg-secondary"></div>
                        <div class="shifting-underline-2 padding-1 bg-primary"></div>
                        </div>
                    </h5>  
                </div>

                <div class="row mx-0">

                    <div class="col-12 px-0 mt-2">
                        @if($dg)
                            <div class="col-12 px-0 my-3 text-center border-bottom text-md-left">
                                <div class="row">
                                    <div class="col-12 col-md-4 col-lg-3 mb-3">
                                        <img class="align-self-center img-fluid mr-3"
                                             style="max-height: 150px !important;"
                                             src="{{  url('/uploads/administration/'.$dg->photo_url) }}"
                                             alt="{!! $dg->fullname !!} photo">
                                    </div>

                                    <div class="col-12 col-md-8 col-lg-9 mb-3 media-body align-self-center">
                                        <h5 class="">
                                            {{-- {{label('lbl_name')}}:  --}}
                                            <span class="text-primary bold-600">{{ $dg->salutation.' '.$dg->fullname }}</span>
                                        </h5>
                                        <h5 class="">
                                            {{-- {{label('lbl_name')}}:  --}}
                                            <span class="text-primary bold-600">{{ $dg->title }}</span>
                                        </h5>
                                        @if($dg->email)
                                            <p class="my-1">
                                                <span class="font-weight-bold"> <i class="fa fa-envelope"></i> : </span>
                                                <a title="Send Email" href="mailto:{{$dg->email}}">{{ $dg->email }}</a>
                                            </p>
                                        @endif
                                        @if($dg->phone)
                                            <p class="my-1">
                                                <span class="font-weight-bold"> <i class="fa fa-phone"></i> : </span>
                                                <a title="Call" href="tel:{{$dg->phone}}">{{ $dg->phone }}</a>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-12 px-0 mt-3">
                            <div class="rich-text">
                                @if($dg_message)
                                    {!! $dg_message->content !!}
                                @else
                                    {{label('lbl_no_information')}}
                                @endif
                            </div>
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


@stop


