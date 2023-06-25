@extends('cms.application')
@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-12">
									<div class="page-header-title">
											<h5 class="m-b-10">Preferences</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">Site Settings</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Preferences</a></li>
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

					<div class="col-12">
						<div class="card">
							@if(empty($preference))
								<div class="card-header" > <h5>Add Preferences Settings</h5></div>
								<div class="card-body">
									{!! Form::open(['route' => 'cms.preferences.index', 'files' => true]) !!}

										@include('cms.preferences._form', ['submitButton' => "Save"])

									{!! Form::close() !!}
								</div>
							@else
								<div class="card-header" > <h5>Edit Preferences Settings</h5></div>
								<div class="card-body">
									{!! Form::model($preference, ['route' => ['cms.preferences.update', $preference->id], 'files' => true, 'method' => 'PATCH']) !!}

										@include('cms.preferences._form', ['submitButton' => "Update"])

									{!! Form::close() !!}

									<div class="my-3 py-3">
										{!! link_to_route('cms.preferences.destroy', "Delete Preferences", array($preference->id), array('data-method' => 'delete', 'data-confirm' => 'Are you Sure' ,'class' => 'label theme-b bg-danger text-white f-12 px-5 py-3')) !!}
									</div>
								</div>
							@endif
						</div>
					</div>

				</div>
			</div>
	</div>
	<!-- [ Main Content ] end -->
@stop
