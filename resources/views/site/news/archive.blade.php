@extends('site.inner')
@section('title')
{!! label('lbl_news') !!} - {{ date('M, Y', strtotime($year_month)) }}
@endsection


@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('news')}}">{{label('lbl_news')}}</a></li>
<li class="breadcrumb-item">{{ label('lbl_archive') }}</li>
<li class="breadcrumb-item active" aria-current="page"> {{ date('M, Y', strtotime($year_month)) }} </li>
@endsection

{{-- @section('page_title')
{!! label('lbl_news') !!}
@endsection --}}

@section('page_content')

<div class="about-page main-container container-fluid bg-white">
	<div class="col-12">
	
		<div class="row">
			<div class="col-lg-12 px-0 my-2 page-content">

				<div class="row mx-0">
					<div class="col-12 py-1 px-0 border-bottom-faded">
						<h5 class="pl-0  text-uppercase "> 
						  <div class="d-block  py-1 lines position-relative">
							<div class="pr-sm-2 py-1 text-primary  position-relative"> 
							<span class="border-left-primary text-dark  pl-1  d-inline-block ">
							  <span class="border-left-secondary-thick pl-2  d-inline-block"> {!! label('lbl_news') !!} - {{ date('M, Y', strtotime($year_month)) }}</span> 
							</span>
							</div>
						  </div>                
						</h5>   
					</div>

					@if(count($news_list))
						<div class="col-12 px-0">
							<div class="card-deck mx-0">
								@foreach ($news_list as $key=>$news)
									<div class="col-12 col-sm-6 col-lg-3 px-0 pb-3 my-2 bg-white border-bottom-r-nolast position-relative rounded overflow-hidden d-flex align-items-center ">
										<div class="w-100 h-100 p-2 position-relative ">      
											<a href="{{url('news/'.$news->slug)}}" class="d-block border w-100 h-100 align-items-center p-0 zoom-container">
												<div class="p-0">
													<div class="full-hd-container rounded overflow-hidden">
														<img class="image" src="{{asset('uploads/news/'.$news->photo_url)}}">
													</div>
												</div>
												<div class="p-2">
													<div class="text-muted bold-600 w-100 item-date">
														<span class="d-inline-block mr-3">
															<i class="fa fa-calendar-alt mr-1"></i> {!! date('d M, Y', strtotime($news->created_at)) !!}
														</span>
													</div>       
													<div> {!! str_limit(strip_tags($news->title) ,120) !!} </div>  
												</div>
											</a>                    
										</div>
									</div>
								@endforeach
							</div>
						</div>

						<div class="col-12 px-0 mt-5 d-flex justify-content-center">
							{!! $news_list->render() !!}
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