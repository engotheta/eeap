@extends('site.inner')

@section('title')
{{label('lbl_not_found')}}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">{{label('lbl_not_found')}}</li>
@endsection

{{-- @section('page_title')
{{label('lbl_not_found')}}
@endsection --}}

@section('page_content')

<div class="about-page main-container container-fluid bg-white">
    <div class="col-12">
    
        <div class="row">
            <div class="col-lg-8 px-0 my-2 pr-lg-5 page-content">

                <div class="col-12 px-0 mb-3 pb-2 border-bottom border-3">
					<h3 class="main-heading"> {{ label('lbl_not_found') }} </h3>
				</div>

                <div class="row mx-0">
                        
                    <div class="col-12 px-0 mt-2">
                        <div class="bold-600 py-2">
                            {!! label('lbl_resource_not_found') !!}
                        </div>
                        <div class="py-3">
                            <form class="pt-3 form-inline py-0 mr-auto" method="GET" action="{{url('search')}}">
                                <div class="col-12 col-md-8 px-0 input-group mb-3">
                                    <input name="q" type="text" class="form-control" placeholder="{{label('lbl_search1')}}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">
                                            <i class="fas fa-search mr-2"></i> <span class="d-none d-sm-inline">{{label('lbl_search')}}</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>

            </div>
            <div class="col-lg-4 px-0">
                @include('site.includes/sidebar')
            </div>
        </div>
        
    </div>

</div>

@stop
