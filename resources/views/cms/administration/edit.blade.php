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
										<li class="breadcrumb-item"><a href="javascript:">User Administration</a></li>
										<li class="breadcrumb-item"><a href="{{ url('/cms/administration') }}">Administration Member</a></li>
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
							<div class="card-header" > <h5>Edit {{ $administration->title_en }}s</h5></div>
							<div class="card-body">

						{!! Form::model($administration, ['route' => ['cms.administration.update', $administration->id], 'files' => true, 'method' => 'PATCH']) !!}

							<div class="row justify-content-center">
								<div class="col-md-6">
									@include('cms.includes.cropimage',['img' => asset('/uploads/administration/'.$administration->photo_url),'aspectRatio'=>1/1])

								</div>
							</div>
							@include('cms.administration._form', ['submitButton' => "Update"])

          				{!! Form::close() !!}

							</div>
						</div>
					</div>

				</div>
			</div>
	</div>
	<!-- [ Main Content ] end -->

@stop
