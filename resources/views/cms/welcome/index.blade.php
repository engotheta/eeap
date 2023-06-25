@extends('cms.application')
@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-12">
									<div class="page-header-title">
											<h5 class="m-b-10">Welcome Note</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">Site Contents</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Informations</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Welcome Note</a></li>
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

					@if(empty($welcome))

						<div class="col-12">
							<div class="card">
								<div class="card-header" > <h5>Create New welcome Note</h5></div>
								<div class="card-body">
									{!! Form::open(['route' => 'cms.welcome.index', 'files' => true]) !!}

										@include('cms.welcome._form', ['submitButton' => "Save"])

									{!! Form::close() !!}
								</div>
							</div>
						</div>

					@else
						<div class="col-12">
							<div class="accordion" id="accordionExample">

									{!! Form::model($welcome, ['route' => ['cms.welcome.update', $welcome->id], 'files' => true, 'method' => 'PATCH']) !!}

										@include('cms.welcome._form', ['submitButton' => "Update"])

									{!! Form::close() !!}

							</div>
						</div>
					@endif

				</div>
			</div>
	</div>
	<!-- [ Main Content ] end -->
@stop
