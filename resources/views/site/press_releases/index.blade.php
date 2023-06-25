@extends('site.inner')

@section('title')
{{label('lbl_press')}}
@endsection

@section('breadcrumb')
{{breadcrumb()}}
@endsection

{{-- @section('page_title')
{{label('lbl_press')}}
@endsection --}}

@section('page_content')
<div class="bg-gradient-white-light h-100 w-100 position-absolute top-left"></div>
<div class="about-page main-container container-fluid bg-white">
    <div class="col-12">
    
        <div class="row">
            <div class="col-lg-8 px-0 my-2 pr-lg-5 page-content">

                <div class="row mx-0 has-shifting-underline">
					<div class="col-12 py-1 px-0">
						<h5 class="pb-2 position-relative page-title text-uppercase text-primary hover-text-primary"> 
							<span class="d-inline-block py-2 position-relative text-bold text-primary">
							  <span class="px-2222">{!! label('lbl_press') !!}</span>
							</span>
							<div class="d-flex w-100 position-absolute bottom-left">
							<div class="shifting-underline-1 padding-1 bg-secondary"></div>
							<div class="shifting-underline-2 padding-1 bg-primary"></div>
							</div>
						</h5>
                    </div>

					@if (count($press_releases ))
						<div class="col-12 mt-4 px-0">
							@foreach ($press_releases  as $press_release)
								<div class="col px-0">  
									<div class="d-flex align-items-center h-100 w-100 pointer-hover border-bottom-faded 
									box-shadow-slight bg-white p-2 mb-2 position-relative">                                    
										<a href="{{url('press-releases/'.$press_release->slug)}}" class="py-3 d-flex w-100 list-item  align-items-center">
											<i class="fa fa-file-medical-alt pr-4 c-green align-self-center text-lg"></i>
											<i class="fa fa-file-alt text-info pr-4 align-self-center text-lg"></i>
											<div class="">
												<div class="bold-600 text-muted">{!! date('d M, Y', strtotime($press_release->created_at)) !!}</div>
												<div> {!! str_limit(strip_tags($press_release->name ) ,120) !!} </div>
											</div>   
										</a>
									</div>
								</div>
							@endforeach
						</div>

						<div class="col-12 pt-5 pb-3 d-flex justify-content-center">
							{!! $press_releases ->render() !!}
						</div>
					@else
						<div class="col-12 px-0 py-3 bold-600">
							{{label('lbl_no_information')}}
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
