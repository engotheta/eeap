@extends('site.inner')

@section('title')
{!! label('lbl_events') !!}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">{{ label('lbl_events') }}</li>
@endsection

{{-- @section('page_title')
{!! label('lbl_events') !!}
@endsection --}}

@section('page_content')
<div class="bg-gradient-white-light h-100 w-100 position-absolute top-left"></div>
<div class="about-page main-container container-fluid bg-white">
	<div class="col-12 ">
	
		<div class="row ">
			<div class="col-lg-12 px-0 my-2 page-content has-shifting-underline">
			
				<div class="row mx-0">

					<div class="col-12 py-1 px-0 ">
						<h5 class="pb-2 position-relative page-title text-uppercase text-primary hover-text-primary"> 
							<span class="d-inline-block py-2 position-relative text-bold text-primary">
							  <span class="px-2222">  {!! label('lbl_events') !!} </span>
							</span>
							<div class="d-flex w-100 position-absolute bottom-left">
							<div class="shifting-underline-1 padding-1 bg-secondary"></div>
							<div class="shifting-underline-2 padding-1 bg-primary"></div>
							</div>
						</h5>  
					</div>
	
					@if(count($events))
						<div class="col-12 px-0 mt-3">
							<div class="card-deck mx-0">
								@foreach ($events as $key=>$event)
									<div class="col-md-6 col-lg-4 d-flex px-0 px-lg-3 py-2 flex-column justify-content-between">
										<div class="box-shadow h-100 mb-4 rounded-smallll border-none overflow-hidden  bg-white show-more-content-news">
										  <a href="{{url('/events/'.$event->slug)}}" class="zoom-container">
											<div class="overflow-hidden full-hd-container position-relative bg-secondary">
											  <img class="card-img-top image" src="{{asset('uploads/events/'.$event->photo_url)}}" alt="Card image cap">
											  <div class="dark-overlay"></div>
											</div>
											<div class="position-relative h-100">
											  <div class="p-3 px-4 bg-white content text-dark">
												<div class="">
												  <h6 class="card-text text-muted pb-3 small text-primary">
													<span class="d-inline-block mr-3">
														<i class="fa fa-calendar-alt mr-1"></i> {!! date('d M, Y', strtotime($event->event_date)) !!}
													</span>
													<span class="d-inline-block">
														<i class="fa fa-map-marker mr-1"></i> {!! $event->location !!}
													</span> 
												</h6>
												  <h6 class="card-text text-bold">{{str_limit($event->title,40)}}</h6>                                    
												</div>  
												<div class="card-text px-4 more-content">
												  <div class="text"> {{str_limit(strip_tags($event->content),80)}} </div>
												</div> 
											  </div>                               
											</div>
										  </a>
										</div>
									</div>
								@endforeach
							</div>
						</div>

						<div class="col-12 px-0 mt-5 d-flex justify-content-center">
							{!! $events->render() !!}
						</div>
					@else
						<div class="col-12 px-0 py-3">
							{{label('lbl_no_information')}}
						</div>
					@endif
											
				</div>
  
			</div>
			
		</div>
		
	</div>
</div>

@stop