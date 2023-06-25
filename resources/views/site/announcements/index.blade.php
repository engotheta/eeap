@extends('site.inner')

@section('title')
{{label('lbl_announcements')}}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">{{ label('lbl_announcements') }}</li>
@endsection

{{-- @section('page_title')
{{ label('lbl_announcements') }}
@endsection --}}

@section('page_content')

<div class="bg-gradient-white-light h-100 w-100 position-absolute top-left"></div>
<div class="about-page main-container container-fluid bg-white">
    <div class="col-12">
    
        <div class="row">
            <div class="col-lg-8 px-0 my-2 pr-lg-5 page-content has-shifting-underline">
			
                <div class="row mx-0">
					<div class="col-12 px-0 py-1">
						<h5 class="pb-2 position-relative page-title text-uppercase text-primary hover-text-primary"> 
							<span class="d-inline-block py-2 position-relative text-bold text-primary">
								<span class="px-2222">{{ label('lbl_announcements') }}</span>
							</span>
							<div class="d-flex w-100 position-absolute bottom-left">
							<div class="shifting-underline-1 padding-1 bg-secondary"></div>
							<div class="shifting-underline-2 padding-1 bg-primary"></div>
							</div>
						</h5>
					</div>

					@if (count($announcements))
						<div class="col-12 mt-4 px-0">
							
							@foreach ($announcements as $announcemente)
								<div class="col px-0">  
									<div class="d-flex align-items-center h-100 w-100 pointer-hover border-bottom-faded 
									box-shadow-slight bg-white p-2 mb-2 position-relative">                                    
										<a href="{{url('announcements/'.$announcemente->slug)}}" class="py-3 d-flex w-100 list-item  align-items-center">
											<i class="fa fa-file-medical-alt pr-3 text-secondary align-self-center text-lg"></i>
											<i class="fa fa-file-alt text-primary pr-3 align-self-center text-lg"></i>
											{{-- <img src="{{asset('site/images/svgs/web.svg')}}" 
											class="fa hover-bounce white-icon pr-3 align-self-center" style="width: 30px; height:auto"> --}}
											<div class="">
												<div class="bold-600 text-muted">{!! date('d M, Y', strtotime($announcemente->created_at)) !!}</div>
												<div> {!! str_limit(strip_tags($announcemente->name ) ,120) !!} </div>
											</div>   
										</a>
									</div>
								</div>
							@endforeach

						</div>

						<div class="col-12 pt-5 pb-3 d-flex justify-content-center">
							{!! $announcements->render() !!}
						</div>
					@else
						<div class="col-12 px-0 py-3 bold-600">
							{{label('lbl_no_information')}}
						</div>
					@endif
                </div>

            </div>
            <div class="col-lg-4 pt-2 px-0">
                @include('site.includes/sidebar')
            </div>
        </div>
        
    </div>

</div>

@stop
