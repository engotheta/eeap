@extends('cms.application')
@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-12">
									<div class="page-header-title">
											<h5 class="m-b-10">Commissioner's Desk</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">Site Contents</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Informations</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Commissioner's Desk</a></li>
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

					@if(empty($dg_message))

						<div class="col-12">
							<div class="card">
								<div class="card-header" > <h5>Create New Commissioner's Desk</h5></div>
								<div class="card-body">
									{!! Form::open(['route' => 'cms.dg_messages.index', 'files' => true]) !!}

										@include('cms.dg_messages._form', ['submitButton' => "Save"])

									{!! Form::close() !!}
								</div>
							</div>
						</div>

					@else
						<div class="col-12">
							<div class="accordion" id="accordionExample">

									{!! Form::model($dg_message, ['route' => ['cms.dg_messages.update', $dg_message->id], 'files' => true, 'method' => 'PATCH']) !!}

										@include('cms.dg_messages._form', ['submitButton' => "Update"])

									{!! Form::close() !!}

							</div>
						</div>
					@endif

				</div>
			</div>
	</div>
	<!-- [ Main Content ] end -->
@stop
