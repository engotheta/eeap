@extends('site.inner')

@section('title')
{{label('lbl_hospitals')}}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">{{ label('lbl_hospitals') }}</li>
@endsection

{{-- @section('page_title')
{{ label('lbl_hospitals') }}
@endsection --}}

@section('page_content')

<div class="bg-gradient-white-light h-100 w-100 position-absolute top-left"></div>
<div class="about-page main-container container-fluid bg-white">
    <div class="col-12">
    
        <div class="row">
            <div class="col-lg-8 px-0 my-2 pr-lg-5 page-content">
			
                <div class="row mx-0">
					<div class="col-12 px-0 py-1 border-bottom-faded">
						<h5 class="pl-0  text-uppercase "> 
							<div class="d-block  py-1    lines position-relative">
							  <div class="pr-sm-2 py-1 text-primary  position-relative"> 
								<span class="border-left-primary text-bold  pl-1 ">
									<span class="border-left-secondary-thick pl-2"> {{ label('lbl_hospitals') }}</span> 
								</span>
							  </div>
							</div>                
						</h5>   
					</div>

					@if (count($hospitals))
						<div class="col-12 mt-4 px-0">
							
							@foreach ($hospitals as $hospital)
								<div class="">  
									{{-- <a href="{{url('hospitals/'.$hospital->slug)}}" --}}
									<div
										class="row mx-0 align-items-center has-hover-bounce h-100 w-100 border-bottom-faded 
									 	 box-shadow-slight bg-white p-2 px-md-3 mb-2 position-relative  has-hidden-items">                                    
										<div class="bg-primaryyy d-flex justify-content-center " style="width:60px">
											<img src="{{asset('site/images/svgs/hospital.svg')}}" 
											class="fa cursor-pointer hidden-toggler hover-bounceee faded white-iconnn align-self-center move-up" style="width: 40px; height:auto">
										</div>
										<div class="col text-dark border-left">
											<div class="text-bold text-hover-primary hidden-toggler cursor-pointer">{{ $hospital->name}} </div>
											@if($hospital->address)
												<div class="hidden-item d-none border-top pt-2 mt-2 move-up" style="--order:1.5">
													<div class="d-flex">
														<i class="fa fa-map-signs  text-muted fadedd  pr-3 mt-2"></i>
														<span> {!! $hospital->address !!}</span>
													</div>
												</div>
											@endif
											@if($hospital->phone) 
												<div class="hidden-item d-none move-up" style="--order:2"><i class="fa text-muted fadedd fa-phone pr-3"></i> {{$hospital->phone}} </div>
											@endif
											@if($hospital->email) 
												<div class="hidden-item d-none move-up" style="--order:2.5"><i class="fa text-muted fadedd fa-envelope pr-3"></i> {{$hospital->email}}</div>
											@endif
										</div>   
									</div>
								</div>
							@endforeach

						</div>

						<div class="col-12 pt-5 pb-3 d-flex justify-content-center">
							{!! $hospitals->render() !!}
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
