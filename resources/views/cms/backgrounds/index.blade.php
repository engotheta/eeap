@extends('cms.application')
@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-12">
									<div class="page-header-title">
											<h5 class="m-b-10">Backgrounds</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">Site Contents</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Media Center</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Backgrounds</a></li>
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

					@if(empty($backgrounds))

						<div class="col-12">
							<div class="card">
								<div class="card-header" > <h5>Add Background Photos</h5></div>
								<div class="card-body">
									{!! Form::open(['route' => 'cms.backgrounds.index', 'files' => true]) !!}
										@include('cms.backgrounds._form', ['submitButton' => "Save"])
									{!! Form::close() !!}
								</div>
							</div>
						</div>

					@else
						<div class="col-12">
							<div class="card">
								<div class="card-header" > <h5>Current Background Photos</h5></div>
								<div class="card-body">
									<div class="py-3">
										<h5>MAIN BACKGROUND</h5>
										<img loading="lazy" class="img-fluid" src="{{asset($backgrounds->main_bg)}}" alt="Main Background" style="max-height:200px">
									</div>
									{{-- <div class="py-3">
										<h5>BANNER BACKGROUND</h5>
										<img loading="lazy" class="img-fluid" src="{{asset($backgrounds->banner_bg)}}" alt="Banner Background" style="max-height:100px">
									</div> --}}

									{{-- @if($backgrounds->second_bg)
										<div class="py-3">
											<h5>SECOND HOMEPAGE BACKGROUND</h5>
											<img loading="lazy" class="img-fluid" src="{{asset($backgrounds->second_bg)}}" alt="Second Background" style="max-height:200px">
										</div>
									@endif --}}

									<div class="py-3">
										{!! link_to_route('cms.backgrounds.destroy', "Delete Backgrounds", array($backgrounds->id), array('data-method' => 'delete', 'data-confirm' => 'Are you Sure' ,'class' => 'label theme-b bg-danger text-white f-12')) !!}
									</div>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="card">
								<div class="card-header" > <h5>Edit Background Photos</h5></div>
								<div class="card-body">
									{!! Form::model($backgrounds, ['route' => ['cms.backgrounds.update', $backgrounds->id], 'files' => true, 'method' => 'PATCH']) !!}

										@include('cms.backgrounds._form', ['submitButton' => "Update"])

									{!! Form::close() !!}
								</div>
							</div>
						</div>
					@endif

				</div>
			</div>
	</div>
	<!-- [ Main Content ] end -->
@stop
