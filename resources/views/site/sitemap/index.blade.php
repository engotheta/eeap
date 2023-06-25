@extends('site.inner')

@section('title')
	{!! label('lbl_sitemap') !!}
@endsection

@section('css-content')
	<style type="text/css">
		.sitemap-list ul ul{
			margin-left:1.5rem !important;
		}
		.sitemap-list ul ul li{
			padding: 3px 0px;
			list-style-type: square;
		}
		.sitemap-list ul ul ul li{
			list-style-type: disc;
		}
		.sitemap-list ul ul ul ul li{
			list-style-type: circle;
		}
	</style>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">{{ label('lbl_sitemap') }}</li>
@endsection

{{-- @section('page_title')
{!! label('lbl_sitemap') !!}
@endsection --}}

@section('page_content')

<div class="about-page main-container container-fluid bg-white">
    <div class="col-12">
    
        <div class="row">
            <div class="col-lg-8 px-0 my-2 pr-lg-5 page-content">

                <div class="row mx-0 has-shifting-underline">
					<div class="col-12 py-1 px-0">
						<h5 class="pb-2 position-relative page-title text-uppercase text-primary hover-text-primary"> 
							<span class="d-inline-block py-2 position-relative text-bold text-primary">
							  <span class="px-2222"> {{ label('lbl_sitemap') }}</span>
							</span>
							<div class="d-flex w-100 position-absolute bottom-left">
							<div class="shifting-underline-1 padding-1 bg-secondary"></div>
							<div class="shifting-underline-2 padding-1 bg-primary"></div>
							</div>
						  </h5>   
					  </div>
                        
                    <div class="col-12 px-0 mt-2 sitemap-list">
                        <ul class="list-unstyled ml-0">
							<li><a class="hover-color-primary" href="{{url('/')}}"> <b><i class="fas fa-home"></i> {{label('lbl_home')}} </b> </a>
							@foreach(App\Models\MenuItem::where('parent','=',0)->get() as $menu)
	
						   <ul class="">
							 <li><a class="hover-color-primary" href="{{ url($menu->url) }}"> <b>{{ $menu->title }}</b> </a>
	
							   @if(App\Models\MenuItem::where('parent','=',$menu->id)->count() > 0)
							   <ul>
								 @foreach(App\Models\MenuItem::where('parent','=',$menu->id)->orderBy('position', 'ASC')->get() as $sub_menu)
									 <li><a class="hover-color-primary" href="{{ url($sub_menu->url) }}">  {{ $sub_menu->title }}</a></li>
	
									 @if(App\Models\MenuItem::where('parent','=',$sub_menu->id)->count() > 0)
									<ul>
										@foreach(App\Models\MenuItem::where('parent','=',$sub_menu->id)->orderBy('position', 'ASC')->get() as $sub_item_menu)
											<li><a class="hover-color-primary" href="{{ url($sub_item_menu->url) }}">  {{ $sub_item_menu->title }}</a></li>
										@endforeach
									</ul>
									@endif
								 @endforeach
							   </ul>
							   @endif
							 </li>
						   </ul>
						   @endforeach
						</ul>
                    </div>
                    
                </div>

            </div>
            <div class="col-lg-4 px-0 mt-2">
                @include('site.includes/sidebar')
            </div>
        </div>
        
    </div>

</div>


@stop
