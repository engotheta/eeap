@extends('site.layout')
@section('title')

{!! label('lbl_projects') !!}

@endsection

@section('content')

<div class="breadcumb-banner" > 
    <div class="banner container px-0">    
      <div class="banner-inner px-0">
          <ol class="breadcrumb ">
            <li class="breadcrumb-item "><a href="{{url('/')}}"><span class="fas fa-home"></span></a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ label('lbl_projects') }}</li>
		</ol>
      </div>
    </div>
</div>

<div class="about-page main-container page-content container bg-white px-lg-5 px-3 py-5">
    <div class="col-12 px-0">
        
      <div class="row mx-0">

		<div class="col-12 px-0 mb-3 pb-2 border-bottom border-3">
			<h3 class="main-heading"> {{ label('lbl_projects') }} </h3>
		</div>
		
		<div class="col-12 px-0">

			<div class="col-12 px-0 py-3">
				{!! label('lbl_projects_msg') !!}
			</div>

			@if (count($projects))
				<div class="row mx-0 py-3">
					@foreach ($projects as $project)
						
						<div class="col-lg-4 col-md-6 service my-3">
							<div class="service-container matte rounded-slight">
								<div class="matte">
									<div class="service-image full-potrait-container" >
										<img class=" " src="{{asset('uploads/projects/'.$project->photo_url)}}" alt="project photo"> 
									</div> 
								</div>
								<div class="service-body text-white">
									<div class="service-contents p-2">
										<h6 class="text-bold py-2"> {!! str_limit(strip_tags($project->title) ,25) !!} </h6>  
										<div class="service-info">
											{!! str_limit(strip_tags($project->content) ,130) !!}
										</div> 
										<div class="my-3"><a class="bg-secondary cursor-pointer my-3 p-2 bold-600 rounded" href="{{url('projects/'.$project->slug)}}">{{label('lbl_readmore')}}</a></div>                  
									</div>                
								</div>  
								<div class="service-title-container text-white matte ">
									<span class="service-title"> {!! str_limit(strip_tags($project->title) ,25) !!} </span> 
								</div>      
							</div>      
						</div>

					@endforeach
				</div>

				<div class="col-12 pt-5 pb-3 d-flex justify-content-center">
					{!! $projects->render() !!}
				</div>

			@else
				<div class="col-12 px-0 bold-600">
					{{label('lbl_no_information')}}
				</div>
			@endif

		</div>

      </div>

    </div>

</div>

@stop
