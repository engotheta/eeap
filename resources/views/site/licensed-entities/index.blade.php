@extends('site.inner')

@section('title')
{{label('lbl_licensed_entities')}}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">{{ label('lbl_licensed_entities') }}</li>
<li class="breadcrumb-item active" aria-current="page">{{ $category->title}}</li>
@endsection

{{-- @section('page_title')
{{ label('lbl_licensed_entities') }}
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

					@if($licensedEntities->count() || isset($term))
					   <div class="mt-1 col-12">
							<div class="w-100 d-flex justify-content-end  text-center mt-3">
								<form class="form-inline d-flex rounded-medium border-primaryy bg-dark-light overflow-hidden" 
									action="{{url('search-licensed-entities')}}" style="width:360px">
									@csrf
									<input hidden type="text" name="category" value="{{$category->slug}}"> 
									<input class="col form-control search-input border-0 bg-none text-primary "
									 value="{{isset($term)? $term:''}}"
									 type="search" name="q" placeholder="{{label('lbl_search')}}" aria-label="Search"/>
									<button type="submit" class="text-primary   border-left faded btn  border-color-white" name="button">
										<i class="fas fa-search fa-1x"></i>
									</button>
								</form>
							</div>
							<div class="box-shadow rounded-smallll border-none overflow-hidden  bg-white position-relative mb-4  mt-2 ">
							
								<div class="row text-primary text-bold border-bottom-primary border-width-2 bg-dark-light text-uppercase">
								<div class="col-md-5 col-sm-5 col-6 pl-4 py-2 "><span class="pr-3"> # </span>  {{label('lbl_name')}}</div>
								<!--<div class="col-md-4 col-sm-4 col-6 px-2 border-left py-2 "> {{label('lbl_phone')}}</div>-->
								{{-- <div class="col-md-3 d-none d-md-flex px-2 border-left py-2 "> {{label('lbl_email')}}</div> --}}
								<!--<div class="col-md-3 col-sm-3 d-none d-sm-flex px-2 pr-4 border-left py-2 "> {{label('lbl_location')}}</div>-->
								</div>
								@foreach ($licensedEntities as $key => $entity)
									<div data-name="{{$entity->name}}" class="searchable-record">
										<a href="{{url('licensed-entities/'.$category->slug.'/'.$entity->slug)}}" class="row text-hover-primary cursor-pointerrr  hover-bg border-top">
											<div class="col-md-5 col-sm-5 col-6 pl-4 d-flex align-items-center"><span class="px-2 mr-2 text-center py-2 border-right" style="width:50px"> {{request('page') > 1 ? $key+1-20+(20*request('page')):$key+1}} </span> {{$entity->name}}</div>
											<!--<div class="col-md-4 col-sm-4 col-6  px-2 d-flex align-items-center border-left py-2">{{$entity->phone}} </div>-->
											{{-- <div class="col-md-3 d-none d-md-flex  px-2  align-items-center border-left py-2">{{$entity->email}} </div> --}}
											<!--<div class="col-md-3 col-sm-3 d-none d-sm-flex align-items-center pr-4 border-left py-2">{{$entity->region}}  </div>-->
										</a>
									</div>
								@endforeach
								@if(!$licensedEntities->count())
								     
									<a href="{{url('licensed-entities/'.$category->id)}}" class="d-block text-center p-3">
										<span class="px-3">{{label('lbl_no_records_found')}}</span>
										<button class="btn bg-primary text-white box-shadow-slight rounded-slight"> {{label('lbl_clear_search')}}</button>
									</a>
								@endif
							</div>
						</div>

                        
						<div class="col-12 pt-5 pb-3 d-flex justify-content-center">
							{!! $licensedEntities->render() !!}
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
