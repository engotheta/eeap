@extends('site.inner')

@section('title')
    {!! label('lbl_region_offices') !!}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">{{ label('lbl_region_offices') }}</li>
@endsection

{{-- @section('page_title')
{!! label('lbl_region_offices') !!}
@endsection --}}

@section('page_content')

<div class="about-page main-container container-fluid bg-white">
    <div class="col-12">
    
        <div class="row">
            <div class="col-lg-8 px-0 my-2 pr-lg-5 page-content">

                <div class="row mx-0 has-shifting-underline" >
                    <div class="col-12 py-1 px-0">
                        <h5 class="pb-2 position-relative page-title text-uppercase text-primary hover-text-primary"> 
                            <span class="d-inline-block py-2 position-relative text-bold text-primary">
                              <span class="px-2222">{{ label('lbl_region_offices') }}</span>
                            </span>
                            <div class="d-flex w-100 position-absolute bottom-left">
                            <div class="shifting-underline-1 padding-1 bg-secondary"></div>
                            <div class="shifting-underline-2 padding-1 bg-primary"></div>
                            </div>
                        </h5>   
                    </div>
                        
                    @if(count($regional_offices))
                        <div class="col-12 px-0">
                            <div id="accordion">

                                @foreach($regional_offices as $key => $office)     
                                
                                <div class="card">
                                    <div class="card-header px-0" id="">
                                        <a class="d-block px-3 cursor-pointer text-primary text-left bold-600 @if($key != 0) collapsed @endif" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
                                            <span class="fa fa-chevron-down mr-2"></span> 
                                            {!! $office->name !!}
                                        </a>
                                    </div>
                                
                                    <div id="collapse{{$key}}" class="collapse @if($key == 0) show @endif" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="pb-3">
                                                <div class="bold-600 text-muted pb-1">
                                                    <span class="fa fa-address-book mr-2"></span> {{ label('lbl_address') }}
                                                </div>
                                                <div class="ml-4"> {!! nl2br($office->physical_address) !!} </div>
                                            </div>

                                            @if($office->email)
                                                <div class="pb-3">
                                                    <span class="fa fa-envelope bold-600 text-muted mr-2"></span> {{ $office->email }}
                                                </div>
                                            @endif

                                            @if($office->toll_free)
                                                <div class="pb-3">
                                                    <span class="bold-600 text-muted">{{label('lbl_toll_free')}}: </span> {{ $office->toll_free }}
                                                </div>
                                            @endif

                                            @if($office->phone)
                                                <div class="pb-3">
                                                    <span class="bold-600 text-muted mr-2">{{label('lbl_phone')}}: </span> {{ $office->phone }}
                                                </div>
                                            @endif

                                            @if($office->fax)
                                                <div class="pb-3">
                                                    <span class="bold-600 text-muted mr-2">{{label('lbl_fax')}}: </span> {{ $office->fax }}
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                @endforeach

                            </div>
                        </div>
                        <div class="col-12 px-0 d-flex justify-content-center">
                            {!! $regional_offices->render() !!}
                        </div>

                    @else
                        <div class="col-12 px-0 bold-600">
                            {{ label('lbl_no_information') }}
                        </div>
                    @endif
                    
                </div>

            </div>
            <div class="col-lg-4 px-0 mt-2">
                @include('site.includes/sidebar')
            </div>
        </div>
        
    </div>

</div>

@stop
