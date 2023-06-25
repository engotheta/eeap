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
					@if ($gallery->type =='photos')

						<div class="col-md-12">
							<div class="card">
								<div class="card-header" >
									<h5>Upload Bulk {{ $gallery->type}} For {{ $gallery->title}} Gallery</h5>
									<div class="alert alert-info my-2">
										16:9 is The Recommended Aspect Ratio,
										Please Make Sure all your images are in the same aspect ratio before upload
									</div>
								</div>
								<div class="card-body">
									{!! Form::model($media,['route' => ['cms.media.bulk-upload-images',$gallery->id],'files'=>true,'class'=>'dropzone']) !!}
											{!! Form::hidden('gallery_id',$gallery->id) !!}

											@include('cms.media.bulk_upload_form', ['submitButton' => "Save"])

									{!! Form::close() !!}

								</div>
							</div>
						</div>
						@else
							<div class="alert alert-info my-2">
								Bulk Upload if for Photo Gallery Only
							</div>
					@endif


				</div>
			</div>
	</div>
	<!-- [ Main Content ] end -->

@stop

@section('scripts')
	<script>
	    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

	    Dropzone.autoDiscover = false;
	    var myDropzone = new Dropzone(".dropzone",{
	        maxFilesize: 80,  // 80 mb
	        acceptedFiles: ".jpeg,.jpg,.png,",
	    });
	    myDropzone.on("sending", function(file, xhr, formData) {
	       formData.append("_token", CSRF_TOKEN);
	    });
	    </script>
@stop
