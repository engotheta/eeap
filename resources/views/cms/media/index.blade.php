@extends('cms.application')
@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-7">
									<div class="page-header-title">
											<h5 class="m-b-10">Galleries</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">Site Contents</a></li>
											<li class="breadcrumb-item"><a href="{{ url('/cms/galleries') }}">Galleries</a></li>
											<li class="breadcrumb-item"><a href="javascript:">{{ $gallery->title }}</a></li>
									</ul>
							</div>

							<div class="col-md-5 text-right text-capitalize">
								@if ($gallery->type == 'photos')
										<a href="{{ url('/cms/media/bulk/'.$gallery->id.'/create')}}" class="btn btn-primary">
											<i class="feather icon-upload-cloud"></i> Upload Bulk {{$gallery->type}}
										</a>
								@endif
									<a href="{{ url('/cms/media/list/'.$gallery->id.'/create')}}" class="btn btn-primary">
										<i class="feather icon-upload-cloud"></i> Upload {{$gallery->type}}
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

            <div class="row">


							@if(empty($gallery->{$gallery->type}))
									<div class="col-md-12">
										<div class="alert alert-primary" role="alert">{{ label('lbl_no_information') }}	</div>
									</div>
								@else
		    					<div class="col-md-12">
		    						<div class="card ">
		    							<div class="card-header" > <h5>Media For {{ $gallery->title }}</h5></div>
		    							<div class="card-body">
												<div class="card-columns">

															@foreach($gallery->{$gallery->type} as $key => $med)

																<div class="card hover-show">
																	@if($gallery->type=='photos')
																		<a data-title="{{$med->content}}" href="{{asset('/uploads/gallery/'.$med->filename) }}" data-toggle="lightbox" data-gallery="example-gallery">
																			<img loading="lazy" src="{{asset('/uploads/gallery/'.$med->filename) }}" class="card-img-top">
																		</a>
																	@endif

																	@if($gallery->type=='videos')
																		<a data-title="{{$med->content}}" href="https://www.youtube.com/watch?v={!! utube_hash($med->url) !!}" data-toggle="lightbox" data-gallery="youtubevideos">
																			<img loading="lazy" src="https://img.youtube.com/vi/{!! utube_hash($med->url) !!}/maxresdefault.jpg" class="card-img-top">
																		</a>

																	@endif
																	@if($gallery->type=='audio')
																			{{-- <audio controls>
																				<source src="{{ asset($med->path.$med->url)}}">
																				<source src="{{ asset($med->path.$med->filename)}}" type="audio/jpeg">
																			Your browser does not support the audio element.
																			</audio> --}}
																	@endif
																	<div class="card-block px-0">
																		<h5 class="job-card-desc">{{$med->created_at->format('dS M Y')}}</h5>
																		{{-- <p>@php	echo wordwrap($med->content,30,"</br>")	@endphp	</p> --}}
																		<p>{{$med->content}}	</p>
																		<div class="job-meta-data mb-1 text-right">
																			{{-- // 11-09-2021 removed class show-on-hover from the a links below to avoid bad layout on hovers --}}
																			<a class="" href="#" data-toggle='modal' data-target="#mediaTransfer{{ $med->id }}">
																				<i class="feather icon-share-2"></i>
																			</a>
																			<a class="" href="{{ URL::route('cms.media.edit', $med->id) }}">
																				<i class="feather icon-edit"></i>
																			</a>
																			<a class="" href="{{ URL::route('cms.media.destroy', $med->id) }}" data-method = 'delete'>
																				<i class="feather icon-trash-2 text-danger"></i>
																			</a>
																	</div>
																</div>
																</div>

																<div class="modal fade" id="mediaTransfer{{ $med->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
																		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
																				<div class="modal-content">
																						<div class="modal-header">
																								<h5 class="modal-title" id="exampleModalLongTitle"> <b>Transfer To Another Gallery</b> </h5>
																								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																										<span aria-hidden="true">×</span>
																								</button>
																						</div>
																						<div class="modal-body">
																							<div class="row">
																								<div class="col-md-6">
																									@if($gallery->type=='photos')
																										<a data-title="{{$med->content}}" href="{{asset('/uploads/gallery/'.$med->filename) }}" data-toggle="lightbox" data-gallery="example-gallery">
																											<img loading="lazy" src="{{asset('/uploads/gallery/'.$med->filename) }}" class="card-img-top">
																										</a>
																									@endif

																									@if($gallery->type=='videos')
																										<a data-title="{{$med->content}}" href="https://www.youtube.com/watch?v={!! utube_hash($med->url) !!}" data-toggle="lightbox" data-gallery="youtubevideos">
																											<img loading="lazy" src="https://img.youtube.com/vi/{!! utube_hash($med->url) !!}/maxresdefault.jpg" class="card-img-top">
																										</a>

																									@endif
																									<h5 class="job-card-desc">{{$med->created_at->format('dS M Y')}}</h5>
																									<p>{{$med->content}}	</p>
																								</div>


																								<div class="col-md-6">
																									{!! Form::model($med, ['route' => ['cms.media.transfer-media', $med->id], 'method' => 'PATCH']) !!}

																										@include('cms.media.transfer_form', ['submitButton' => "Update"])

																									{!! Form::close() !!}
																								</div>

																							</div>

																						</div>
																				</div>
																		</div>
																</div>

															@endforeach

		    							</div>
		    						</div>
		    					</div>
		    				</div>
							@endif

				</div>
			</div>
	</div>
	<!-- [ Main Content ] end -->

@stop
