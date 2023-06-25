@extends('site.inner')

@section('title')
{{ $category->title }}
@endsection

@section('page_content')

@section('breadcrumb')
    {{ breadcrumb() }}
@endsection
<div class="about-page main-container container-fluid bg-white">
	<div class="col-12 pt-3">
	
		<div class="row mx-0">
			<div class="col-lg-12 px-0 my-2 page-content has-shifting-underline">
  
				<div class="col-12 py-1 px-0">
					<h5 class="pb-2 position-relative page-title text-uppercase text-primary hover-text-primary"> 
						<span class="d-inline-block py-2 position-relative text-bold text-primary">
						  <span class="px-2222">{{ $category->title }}</span>
						</span>
						<div class="d-flex w-100 position-absolute bottom-left">
						<div class="shifting-underline-1 padding-1 bg-secondary"></div>
						<div class="shifting-underline-2 padding-1 bg-primary"></div>
						</div>
					</h5>
				</div>
  
				<div class="row mx-0">
					@if(count($products))

						@foreach ($products as $product)
							<div class="col-lg-4 col-md-6 col-12 py-3 px-0 px-md-3">
								<div class="productCarousel h-100 bg-secondary divide">
									<div class="overflow-hidden h-100">
										<a href="{{url('product-categories/'.$category->slug.'/'.$product->slug)}}" class="carousel-item h-100 active">
											<div class="product-hd-container h-100 position-relative" style="background-image: url({{asset($product->photo_url)}});">
											</div>                  
											<div class="carousel-caption">
											<p class="product-title"> {{$product->title}} </p>
											<p class="product-content"> {{$product->summary}} </p>
											</div>
										</a>
									</div>
								</div>
							</div>
						@endforeach


						<div class="col-12 px-0 mt-5 d-flex justify-content-center">
							{!! $products ->render() !!}
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