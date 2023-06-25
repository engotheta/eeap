@extends('site.inner')

@section('title')
{{ $product->title }}
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
						  <span class="px-2222">{{ $product->title }}</span>
						</span>
						<div class="d-flex w-100 position-absolute bottom-left">
						<div class="shifting-underline-1 padding-1 bg-secondary"></div>
						<div class="shifting-underline-2 padding-1 bg-primary"></div>
						</div>
					</h5>
				</div>

  
				<div class="row mx-0">
					<div class="col-12 px-0">
						<div class="pb-3">
							{!! $product->summary !!}
						</div>
						<div class="py-3 border-bottom">
							<img class="img-fluid mb-3" src="{{asset($product->photo_url)}}" alt="{{$product->title}}">
						</div>
						<div class="py-3">
							{!! $product->content !!}
						</div>
					</div>
				</div>
  
			</div>
			
		</div>
		
	</div>
</div>

@stop