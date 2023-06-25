@extends('cms.application')
@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-12">
									<div class="page-header-title">
											<h5 class="m-b-10">Gallery</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="{{ url('/cms/galleries')}}">Gallaries</a></li>
											<li class="breadcrumb-item"><a href="{{url('cms/media/list/'.$media->gallery->id)}}">{{str_limit($media->gallery->title,40)}}</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Edit </a></li>
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
							<div class="card-header" > <h5>Update {{ ucwords($media->title) }}</h5></div>
							<div class="card-body">
                {!! Form::model($media, ['route' => ['cms.media.update', $media->id], 'method' => 'PATCH']) !!}

                  @if($media->gallery->type =='photos')
                    @include('cms.includes.cropimage',[ 'img' => asset('/uploads/gallery/'.$media->filename)])
                  @endif

                  @include('cms.media.'.$media->gallery->type.'_form', ['submitButton' => "Update"])

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
