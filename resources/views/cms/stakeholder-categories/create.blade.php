@extends('cms.application')
@section('content')


    <!-- [ breadcrumb ] start -->
  	<div class="page-header">
  			<div class="page-block">
  					<div class="row align-items-center">
  							<div class="col-md-12">
  									<div class="page-header-title">
  											<h5 class="m-b-10">Stakeholder Categories</h5>
  									</div>
  									<ul class="breadcrumb">
  											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
  											<li class="breadcrumb-item"><a href="javascript:">Site Contents</a></li>
  											<li class="breadcrumb-item"><a href="{{ url('/cms/stakeholder-categories') }}">Stakeholder Categories</a></li>
  											<li class="breadcrumb-item"><a href="javascript:">Create</a></li>
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
								<h5>New Stakeholder Category</h5>
							</div>
  							<div class="card-body">

								{!! Form::open(['route' => 'cms.stakeholder-categories.index']) !!}

									@include('cms.stakeholder-categories._form', ['submitButton' => "Save"])

								{!! Form::close() !!}

  							</div>
  						</div>
  					</div>

  				</div>
  			</div>
  	</div>
  	<!-- [ Main Content ] end -->

@stop
