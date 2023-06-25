@extends('site.inner')

@section('title')
{{label('lbl_trainings')}}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">{{ label('lbl_trainings') }}</li>
@endsection

{{-- @section('page_title')
{{ label('lbl_trainings') }}
@endsection --}}

@section('page_content')

<div class="bg-gradient-white-light h-100 w-100 position-absolute top-left"></div>
<div class="about-page main-container container-fluid bg-white">
    <div class="col-12">
    
        <div class="row">
            <div class="col-lg-8 px-0 my-2 pr-lg-5 page-content">
			
                <div class="row mx-0 has-shifting-underline">
					<div class="col-12 px-0 py-1">
						<h5 class="pb-2 position-relative page-title text-uppercase text-primary hover-text-primary"> 
							<span class="d-inline-block py-2 position-relative text-bold text-primary">
							  <span class="px-2222"> {{ label('lbl_trainings') }}</span>
							</span>
							<div class="d-flex w-100 position-absolute bottom-left">
							<div class="shifting-underline-1 padding-1 bg-secondary"></div>
							<div class="shifting-underline-2 padding-1 bg-primary"></div>
							</div>
						  </h5> 
					</div>

					@if (count($trainings))
						<div class="col-12 mt-4 px-0">
							
							@foreach ($trainings as $training)
								<a href="{{url('trainings/'.$training->slug)}}" class="d-block">
									<div
										class="row mx-0 align-items-center has-hover-bounce h-100 w-100 border-bottom-faded 
									 	 box-shadow-slight bg-white p-2 px-md-3 mb-2 position-relative  has-hidden-items">                                    
										<div class="bg-primaryyy d-flex justify-content-center " style="width:60px">
											<img src="{{asset('site/images/svgs/training.svg')}}" 
											class="fa cursor-pointer hidden-toggler hover-bounceee faded white-iconnn align-self-center move-up" style="width: 40px; height:auto">
										</div>
										<div class="col text-dark border-left">
											<div class=" text-hover-primary hidden-toggler cursor-pointer">
												{{ $training->title}} 
												<div class="mt-1 faded small">
													@if($training->start_date)
													{{-- <span class="px-2 faded">|</span> --}}
													<span class="hidden-itemmm d-noneeee move-up" style="--order:2">
													   <i class="fa text-muted  fa-calendar pr-3"></i> {{$training->start_date}} 
													</span> 
													@endif
   
												   @if($training->location)
													   <span class="px-2 faded">|</span>
													   <span class="">
														  <i class="fa text-muted  fa-map-marker-alt pr-3"></i>{{$training->location}} 
													   </span>
												   @endif
												</div>
											</div>
										</div>   
									</div>
								</a>
							@endforeach

						</div>

						<div class="col-12 pt-5 pb-3 d-flex justify-content-center">
							{!! $trainings->render() !!}
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
