@extends('site.inner')

@section('title')
{!! label('lbl_documents_center') !!}
@endsection

<?php $all_featured = true ?>
@foreach ($categories as $category) <?php $all_featured = $all_featured && $category->featured == 1 ?>@endforeach

@section('breadcrumb')
<li class="breadcrumb-item @if(!$all_featured) active @endif" aria-current="page">{{ label('lbl_documents_center') }}</li>
@if($all_featured) <li class="breadcrumb-item active" aria-current="page">{{ label('lbl_licensing_requirements') }}</li> @endif
@endsection

@section('page_title')
{!! label('lbl_documents_center') !!}
@endsection

@section('page_content')
<div class="bg-gradient-white-light h-100 w-100 position-absolute top-left"></div>
<div class="about-page main-container container-fluid bg-white">
	<div class="col-12">
	
		<div class="row">
			<div class="col-lg-12 px-0 my-2 page-content">

        
 
				<div class="row mx-0 has-content-title ">
          <div class="col-12 py-1 px-0">
            <h5 class="text-left content-title py-4 mb-4 font-20">{{ label('lbl_documents_center') }}</h5>
          </div>

					@if (count($categories))
            <div class="col-12 px-0">
              <div class="row mx-0 mt-3">
                @foreach ($categories as $category)
                  <div class="col-lg-6 col-12 py-2"> 
                    <a href="{{ url('publications/'.$category->slug) }}" class="d-flex p-3 rounded-slight border-faded box-shadow-slight
                       w-100 h-100 align-items-center pointer-hover">
                        <i class="fa fa-chevron-right text-muted align-self-center fs-2rem"></i>
                        <i class="fa fa-folder-open c-folder align-self-center fs-2rem"></i>
                        <span class="d-inline-block pl-4">
                          <div class="heading-text text-primary bold-600"> {!! $category->title !!} </div>   
                          <div class="font-14 faded text-dark">{{label('lbl_publications')}}: {{ $category->documents_count }}</div>
                        </span>   
                      </a>    
                    </div>
                @endforeach
              </div>
            </div>

            <div class="col-12 pt-5 pb-3 d-flex justify-content-center">
              {!! $categories->render() !!}
            </div>

          @else
            <div class="col-12 bold-600">
              {{label('lbl_no_information')}}
            </div>
          @endif
											
				</div>
  
			</div>
		</div>
		
	</div>
</div>

@stop

