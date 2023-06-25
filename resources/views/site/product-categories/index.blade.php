@extends('site.inner')

@section('title')
{!! label('lbl_our_products') !!}
@endsection

@section('page_content')

@section('breadcrumb')
    {{ breadcrumb() }}
@endsection
<div class="about-page main-container container-fluid bg-white">
	<div class="col-12 px-3 pt-3">
	
		<div class="row mx-0">
			<div class="col-lg-12 px-0 my-2 page-content has-shifting-underline">
  
				<div class="col-12 py-1 px-0">
					<h5 class="pb-2 position-relative page-title text-uppercase text-primary hover-text-primary"> 
						<span class="d-inline-block py-2 position-relative text-bold text-primary">
						  <span class="px-2222">{!! label('lbl_our_products') !!}</span>
						</span>
						<div class="d-flex w-100 position-absolute bottom-left">
						<div class="shifting-underline-1 padding-1 bg-secondary"></div>
						<div class="shifting-underline-2 padding-1 bg-primary"></div>
						</div>
					</h5>
				</div>

				<div class="row mx-0">
					@if(count($products) || isset($term))
					<div class="mt-1 col-12">
						 <div class="w-100 d-flex justify-content-end  text-center mt-3">
							 <form class="form-inline d-flex rounded-medium border-primaryy bg-dark-light overflow-hidden" 
								 action="{{url('search-products')}}" style="width:360px">
								 @csrf
								 <input class="col form-control search-input border-0 bg-none text-primary "
								  value="{{isset($term)? $term:''}}"
								  type="search" name="q" placeholder="{{label('lbl_search')}}" aria-label="Search"/>
								 <button type="submit" class="text-primary   border-left faded btn  border-color-white" name="button">
									 <i class="fas fa-search fa-1x"></i>
								 </button>
							 </form>
						 </div>
						 <div class="box-shadow rounded-small border-none overflow-hidden  bg-white position-relative mb-4  mt-2 ">
						 
							 <div class="row text-primary border-bottom-primary border-width-2 bg-gradient-secondary-white text-uppercase">
								<div class="col-md-2 col-sm-3 col-4 pl-4 d-flex align-items-center py-2"> {{label('lbl_name')}}</div>
								<div class="col-md-2 col-sm-3 col-4  px-2 d-flex align-items-center border-left py-2">{{label('lbl_price')}} </div>
								<div class="col-md-2 col-sm-3 col-4  px-2 d-flex align-items-center border-left py-2">{{label('lbl_quantity')}} </div>
								<div class="col-md-2 d-none d-md-flex  px-2  align-items-center border-left py-2"> {{label('lbl_grade')}}</div>
								<div class="col-md-2 d-none d-md-flex  px-2 align-items-center border-left py-2">{{label('lbl_season')}}  </div>
								<div class="col-md-2 col-sm-3 d-none d-sm-flex align-items-center pr-4 border-left py-2">{{label('lbl_location')}}  </div>
							 </div>
							 @foreach ($products as $product)
								 <div data-name="{{$product->title}}" class="searchable-record">
									 <div href="#" class="row text-hover-primary cursor-pointerrr  hover-bg-secondary-faded border-top">
										 <div class="col-md-2 col-sm-3 col-4 pl-4 d-flex align-items-center py-2"> {{$product->title}}</div>
										 <div class="col-md-2 col-sm-3 col-4  px-2 d-flex align-items-center border-left py-2">{{$product->lowest_price}} - {{$product->highest_price}} </div>
										 <div class="col-md-2 col-sm-3 col-4  px-2 d-flex align-items-center border-left py-2">{{$product->quantity}} </div>
										 <div class="col-md-2 d-none d-md-flex  px-2  align-items-center border-left py-2"> {{$product->grade}}</div>
										 <div class="col-md-2 d-none d-md-flex  px-2 align-items-center border-left py-2">{{$product->season}}  </div>
										 <div class="col-md-2 col-sm-3 d-none d-sm-flex align-items-center pr-4 border-left py-2">{{$product->location}}  </div>
									 </div>
								 </div>
							 @endforeach
							 @if(!count($products))
								  
								 <a href="{{url('products')}}" class="d-block text-center p-3">
									 <span class="px-3">{{label('lbl_no_records_found')}}</span>
									 <button class="btn bg-primary text-white box-shadow-slight rounded-slight"> {{label('lbl_clear_search')}}</button>
								 </a>
							 @endif
						 </div>
					 </div>


					 <div class="col-12 pt-5 pb-3 d-flex justify-content-center">
						 {!! $products->render() !!}
					 </div>
				 @else
					 <div class="col-12 px-0 py-3 bold-600">
						 {{label('lbl_no_information')}}
					 </div>
				 @endif
					
					{{-- @if (count($products))
						<div class="col-12 mt-4 px-0">
							
							@foreach ($products as $product)
								<div class="">  
								
									<div
										class="row mx-0 align-items-center has-hover-bounce h-100 w-100 border-bottom-faded 
									 	 box-shadow-slight bg-white p-2 px-md-3 mb-2 position-relative  has-hidden-items">                                    
										<div class="bg-primaryyy d-flex justify-content-center " style="width:60px">
											<img src="{{asset('site/images/svgs/product.svg')}}" 
											class="fa cursor-pointer hidden-toggler hover-bounceee faded white-iconnn align-self-center move-up" style="width: 40px; height:auto">
										</div>
										<div class="col text-dark border-left">
											<div class="text-bold text-hover-primary hidden-toggler cursor-pointer">
												{{ $product->title}} 

												@if($product->price)
												 <span class="px-2 faded">|</span>
												 <span class="hidden-itemmm d-noneeee move-up" style="--order:2">
													<i class="fa text-muted fadedd fa-money-bill pr-3"></i> {{$product->price}} 
												 </span> 
												 @endif

												<span class="px-2 faded">|</span>
												<span class="faded">
													{{$product->category->title}} 
												</span>
											</div>
										
										</div>   
										@if($product->content)<div class="hidden-item d-none move-up mt-3 p-2 p-md-3 border-top" 
										style="--order:1.5">{!!$product->content!!}</div>@endif
									</div>
								</div>
							@endforeach

						</div>

					
						<div class="col-12 px-0 mt-5 d-flex justify-content-center">
							{!! $products->render() !!}
						</div>
					@else
						<div class="col-12 px-0 py-3">
							{{label('lbl_no_information')}}
						</div>
					@endif
											 --}}
				</div>
  
			</div>
			
		</div>
		
	</div>
</div>

@stop