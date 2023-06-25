@extends('site.inner')

@section('title')
{!! $licensedEntity->name !!}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('licensed-entities/'.$licensedEntity->category->slug)}}">{{$licensedEntity->category->title}}</a></li>
<li class="breadcrumb-item active" aria-current="page">{!! str_limit(strip_tags($licensedEntity->name) ,20) !!}</li>
@endsection

{{-- @section('page_title')
{!! $licensedEntity->name !!}
@endsection --}}

@section('page_content')

<div class="about-page main-container container-fluid bg-white">
    <div class="col-12">
    
        <div class="row">
            <div class="col-lg-8 px-0 my-2 pr-lg-5 page-content">

                <div class="row mx-0 has-shifting-underline">
                    <div class="col-12 py-1 px-0 ">
                        <h5 class="pb-2 position-relative page-title text-uppercase text-primary hover-text-primary"> 
							<span class="d-inline-block py-2 position-relative text-bold text-primary">
							  <span class="px-2222"> {!! $licensedEntity->name !!}</span>
							</span>
							<div class="d-flex w-100 position-absolute bottom-left">
							<div class="shifting-underline-1 padding-1 bg-secondary"></div>
							<div class="shifting-underline-2 padding-1 bg-primary"></div>
							</div>
						  </h5>   
					</div>
                        
                    <div class="col-12 ">
                        {{-- <div class="py-3">
                            <span class="text-muted bold-600 d-inline-block mr-4">
                                <i class="fa fa-calendar-alt mr-1"></i> {!! date('d M, Y', strtotime($licensedEntity->created_at)) !!}
                            </span>
                            <a href="#" target="_blank" rel="noopener noreferrer" class="text-primary d-inline-block">
                                <i class="fa fa-file-download mr-1"></i> DOWNLOAD
                            </a>
                        </div> --}}
                        

                        <?php  
                            $fields=[
                                'principal_officer',
                                'date_of_application',
                                'date_of_license',
                                'number_of_license',
                                'number_of_employees',
                                'district',
                                'status',
                                'principal_insurer_1 as CEO',
                                'country',
                                'principal_insurer_2 as Address',
                                'principal_insurer_3 as Principal Insurer',
                                'phone',
                                'telephone',
                                'email',
                                'website',
                                'class_of_business',
                                'license_type',
                                'physical_address',
                                'region',
                                'address'
                            ];
                    
                        ?>
                        
                        <div class="row">
                            @foreach($fields as $key => $field)
                                <?php $key_= trim(explode(" as ",$field)[0])?>
                                @if(isset($licensedEntity[$key_]) && trim($licensedEntity[$key_])!=null && 
                                !(substr_count($licensedEntity[$key_],0) == 8) && !($licensedEntity[$key_] == 0) )
                                    <div class="col-md-12 last-no-border py-2 border-bottom-faded ">
                                        <div class="faded text-capitalize"> {{strpos($field, " as ") !== false ?  trim(explode(" as ",$field)[1]) : str_replace("_", " ", $field) }} </div>
                                        <div class="text-dark mt-0"> {{str_replace("_", " ", $licensedEntity[$key_])}} </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                      
                    </div>
                    {{-- <div class="col-12 border-top-faded px-0">
                        <div class="rich-text py-3 mt-3">
                            {!! $licensedEntity->address !!}
                        </div>
                    </div> --}}
                    
                </div>

            </div>
            <div class="col-lg-4 px-0">
                @include('site.includes/sidebar')
            </div>
        </div>
        
    </div>

</div>

@stop
