@extends('cms.application')
@section('content')


    <!-- [ breadcrumb ] start -->
  	<div class="page-header">
  			<div class="page-block">
  					<div class="row align-items-center">
  							<div class="col-md-12">
  									<div class="page-header-title">
  											<h5 class="m-b-10">Licensed Entity Categories</h5>
  									</div>
  									<ul class="breadcrumb">
  											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
  											<li class="breadcrumb-item"><a href="javascript:">Site Contents</a></li>
  											<li class="breadcrumb-item"><a href="{{ url('/cms/document-categories') }}">Licensed Entity Categories</a></li>
  											<li class="breadcrumb-item"><a href="javascript:">Edit</a></li>
  									</ul>
  							</div>
  					</div>
  			</div>
  	</div>
  	<!-- [ breadcrumb ] end -->

  	<!-- [ Main Content ] start -->
  	<div class="main-body">
  			<div class="page-wrapper">
  				<div class="row">

  					<div class="col-md-12">
  						<div class="card">
  							<div class="card-header" > 
								<h5>Edit {{ $category->title_en }}</h5>
							</div>
  							<div class="card-body">

								{!! Form::model($category, ['route' => ['cms.licensed-entity-categories.update', $category->id], 'method' => 'PATCH']) !!}

									@include('cms.licensed-entity-categories._form', ['submitButton' => "Update"])
								
								{!! Form::close() !!}

  							</div>
  						</div>
  					</div>

  				</div>
  			</div>
  	</div>
  	<!-- [ Main Content ] end -->

@stop
