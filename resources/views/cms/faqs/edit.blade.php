@extends('cms.application')
@section('content')

  <!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-12">
									<div class="page-header-title">
											<h5 class="m-b-10">Faqs</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">Information</a></li>
											<li class="breadcrumb-item"><a href="{{ url('/cms/faqs') }}">Faqs</a></li>
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

					<div class="col-md-10 col-12">
						<div class="card">
							<div class="card-header" > <h5>Edit FAQ</h5></div>
							<div class="card-body">

								{!! Form::model($faq, ['route' => ['cms.faqs.update', $faq->id], 'method' => 'PATCH']) !!}

									@include('cms.faqs._form', ['submitButton' => "Update"])
				
								{!! Form::close() !!}

							</div>
						</div>
					</div>

				</div>
			</div>
	</div>
	<!-- [ Main Content ] end -->


@stop
