@extends('cms.application')
@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-12">
									<div class="page-header-title">
											<h5 class="m-b-10">Administration</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">Administration</a></li>
											<li class="breadcrumb-item"><a href="{{ url('/cms/administration') }}">Administration Members</a></li>
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
								<div class="card-header" > <h5>New Administration Personel</h5></div>
								<div class="card-body">
									{!! Form::open(['route' => 'cms.administration.index', 'files' => true]) !!}

										<div class="row justify-content-center">
											<div class="col-md-6">
													@include('cms.includes.cropimage',['img' => "",'aspectRatio'=> 1 / 1])
											</div>
										</div>

										@include('cms.administration._form', ['submitButton' => "Save"])

									{!! Form::close() !!}
								</div>
							</div>
						</div>
					</div>
			</div>
	</div>
	<!-- [ Main Content ] end -->

@stop
