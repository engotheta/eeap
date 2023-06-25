@extends('site.inner')

@section('title')
{{label('lbl_operators')}}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">{{ label('lbl_operators') }}</li>
@endsection

{{-- @section('page_title')
{{ label('lbl_operators') }}
@endsection --}}

@section('page_content')

<div class="bg-gradient-white-light h-100 w-100 position-absolute top-left"></div>
<div class="about-page main-container container-fluid bg-white">
    <div class="col-12">
    
        <div class="row">
            <div class="col-lg-12 px-0 my-2 pr-lg-5555 page-content">
			
                <div class="row mx-0">
					<div class="col-12 px-0 py-1 border-bottom-faded">
						<h5 class="pl-0  text-uppercase "> 
							<div class="d-block  py-1    lines position-relative">
							  <div class="pr-sm-2 py-1 text-primary  position-relative"> 
								<span class="border-left-primary text-bold  pl-1 ">
									<span class="border-left-secondary-thick pl-2"> {{ label('lbl_operators') }}</span> 
								</span>
							  </div>
							</div>                
						</h5>   
					</div>

					@if(count($operators) || isset($term))
					   <div class="mt-1 col-12">
							<div class="w-100 d-flex justify-content-end  text-center mt-3">
								<form class="form-inline d-flex rounded-medium border-primaryy bg-dark-light overflow-hidden" 
									action="{{url('search-operators')}}" style="width:360px">
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
								<div class="col-md-3 col-sm-4 col-6 pl-4 py-2 "> {{label('lbl_name')}}</div>
								<div class="col-md-3 col-sm-4 col-6 px-2 border-left py-2 "> {{label('lbl_phone')}}</div>
								<div class="col-md-3 d-none d-md-flex px-2 border-left py-2 "> {{label('lbl_email')}}</div>
								<div class="col-md-3 col-sm-4 d-none d-sm-flex px-2 pr-4 border-left py-2 "> {{label('lbl_address')}}</div>
								</div>
								@foreach ($operators as $operator)
									<div data-name="{{$operator->name}}" class="searchable-record">
										<div href="#" class="row text-hover-primary cursor-pointerrr  hover-bg-secondary-faded border-top">
											<div class="col-md-3 col-sm-4 col-6 pl-4 d-flex align-items-center py-2"> {{$operator->name}}</div>
											<div class="col-md-3 col-sm-4 col-6  px-2 d-flex align-items-center border-left py-2">{{$operator->phone}} </div>
											<div class="col-md-3 d-none d-md-flex  px-2  align-items-center border-left py-2">{{$operator->email}} </div>
											<div class="col-md-3 col-sm-4 d-none d-sm-flex align-items-center pr-4 border-left py-2">{{$operator->address}}  </div>
										</div>
									</div>
								@endforeach
								@if(!count($operators))
								     
									<a href="{{url('operators')}}" class="d-block text-center p-3">
										<span class="px-3">{{label('lbl_no_records_found')}}</span>
										<button class="btn bg-primary text-white box-shadow-slight rounded-slight"> {{label('lbl_clear_search')}}</button>
									</a>
								@endif
							</div>
						</div>


						<div class="col-12 pt-5 pb-3 d-flex justify-content-center">
							{!! $operators->render() !!}
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

@section('js-content')
<script>




</script>

@endsection
