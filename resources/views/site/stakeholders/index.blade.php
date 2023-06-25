@extends('site.inner')

@section('title')
{{label('lbl_stakeholders')}}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">{{ label('lbl_stakeholders') }}</li>
<li class="breadcrumb-item active" aria-current="page">{{ $category->title}}</li>
@endsection

{{-- @section('page_title')
{{ label('lbl_stakeholders') }}
@endsection --}}

@section('page_content')

<div class="bg-gradient-white-light h-100 w-100 position-absolute top-left"></div>

<div class="about-page main-container container-fluid bg-white">
    <div class="col-12">
    
        <div class="row">
            <div class="col-lg-12 px-0 my-2 pr-lg-555 page-content">
			
                <div class="row mx-0 has-shifting-underline">
					<div class="col-12 px-0 py-1">
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

					@if($stakeholders->count() || isset($term))

						@foreach($stakeholders as $key => $stakeholder ) 
							<div class="col-12 mt-1 text-center has-hover-bounce has-shifting-underline  text-center position-relative" >
							<a href="{{isset($stakeholder->url)? $stakeholder->url : url('/stakeholders/'.$category->slug.'/'.$stakeholder->slug)}}" @if(isset($stakeholder->url)) target="_blank" @endif 
								class="h-100  cursor-pointer zoom-container show-more-content-news p-0 d-flex border-bottom box-shadow  
								bg-white last-no-border align-items-center border-faded "  style="min-height:80px"> 
								<div style=" max-width:180px" class="col-3 col-md-4 p-2 h-100 bg-secondary  tex-left  d-flex flex-column justify-content-center pr-0 border-rightt " >
								<div class="border-faded p-1">
									<div class="overflow-hidden box-shadow-slight">
									<div class=" square-container  bg-white image my-0 hover-text-primary background-image" 
										style="background-image:url('{{asset('uploads/stakeholders/'.$stakeholder->photo_url)}}'); max-width:150px" >  
										<div class="dark-overlay"></div>
									</div>
									</div>
								</div>
								</div>
								<div class="col col-md-8 bg-secondary-fadeddd h-100 pl-3 p-3 text-left hover-text-primaryy "> 
									<h5> {{$stakeholder->title}}</h5>
									<div>{!! $stakeholder->content !!}</div>
								</div>
							</a>
							</div>
						@endforeach
								
                        
						<div class="col-12 pt-5 pb-3 d-flex justify-content-center">
							{!! $stakeholders->render() !!}
						</div>
					@else
						<div class="col-12 px-0 py-3 bold-600">
							{{label('lbl_no_information')}}
						</div>
					@endif
                </div>

            </div>
            {{-- <div class="col-lg-4 pt-2 px-0">
                @include('site.includes/sidebar')
            </div> --}}
        </div>
        
    </div>

</div>

@stop
