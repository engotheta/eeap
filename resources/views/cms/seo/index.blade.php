@extends('cms.application')
@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-12">
									<div class="page-header-title">
											<h5 class="m-b-10">SEO</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">Setting</a></li>
											<li class="breadcrumb-item"><a href="javascript:">SEO</a></li>
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
					<div class="col-md-12 col-xs-12">
							<div class="card ">
									<div class="card-header">
											<h5>SEOs</h5>
									</div>
									<div class="card-body">
										@empty ($seo)
											{!! Form::open(['files'=>true, 'route' => ['cms.seo.store']]) !!}
												@include('cms.seo._form',['submittitle'=>'Save'])
											{!! Form::close() !!}
										@else

											{!! Form::model($seo, ['route' => ['cms.seo.update', $seo->id], 'method' => 'PATCH']) !!}

												@include('cms.seo._form',['submittitle'=>'Update'])
											{!! Form::close() !!}

										@endempty

									</div>

							</div>
					</div>

				</div>
			</div>
	</div>
	<!-- [ Main Content ] end -->

@stop
