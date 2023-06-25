@extends('cms.application')
@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-7">
									<div class="page-header-title">
											<h5 class="m-b-10">Gallery</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">Site Contents</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Informations</a></li>
											<li class="breadcrumb-item"><a href="{{ url('/cms/galleries') }}">Gallery </a></li>
											<li class="breadcrumb-item"><a href="javascript:">{{$gallery->type}} </a></li>
									</ul>
							</div>

							<div class="col-md-5 text-right text-capitalize">
									<a href="{{ url('/cms/media/list/'.$gallery->id)}}" class="btn btn-primary">
										<i class="feather icon-arrow-left"></i> Go Back To {{$gallery->type}}
									</a>
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
							<div class="card-header" > <h5>Upload {{ $gallery->type}} For {{ $gallery->title}} Gallery</h5></div>
							<div class="card-body">
								{!! Form::model($media,['route' => 'cms.media.store','files'=>true]) !!}
										{!! Form::hidden('gallery_id') !!}
										{!! Form::hidden('type',$gallery->type) !!}

										@if($gallery->type=='photos')
											@include('cms.includes.cropimage',['img' => ''])
										@endif

									@include('cms.media.'.$gallery->type.'_form', ['submitButton' => "Save"])

								{!! Form::close() !!}

							</div>
						</div>
					</div>


				</div>
			</div>
	</div>
	<!-- [ Main Content ] end -->

@stop

@section('scripts')

@stop
