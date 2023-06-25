@extends('cms.application')
@section('stylesheets')
	<link rel="stylesheet" href="{{ asset('admin/css/movable_menu.css') }}" >
@stop

@section('content')
	<!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-7">
									<div class="page-header-title">
											<h5 class="m-b-10">About Us Links</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">Site Contents</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Links</a></li>
											<li class="breadcrumb-item"><a href="javascript:">About Us Links</a></li>
									</ul>
							</div>
							<div class="col-md-5 text-right text-capitalize" id="nestable-menu">

									<button class="btn btn-outline-primary btn-sm m-r-10" data-action="expand-all">Expand All</button>
									<button class="btn btn-outline-secondary btn-sm" data-action="collapse-all">Collapse All</button>

							</div>
					</div>
			</div>
	</div>
	<!-- [ breadcrumb ] end -->

	<!-- [ Main Content ] start -->
	<div class="main-body">
			<div class="page-wrapper">
				<div class="row">

					<div class="col-md-4">
						<div class="card">
							<div class="card-header" > <h5>New About Us Link</h5></div>
							<div class="card-body">
								{!! Form::open(['route' => 'cms.about_links.index']) !!}

									@include('cms.about_links._form', ['submitButton' => "Save"])

								{!! Form::close() !!}
							</div>
						</div>
					</div>

					<div class="col-md-8">
						<div class="card">
							<div class="card-header" > <h5>List Of About Us Links</h5></div>
							<div class="card-body">
								@if($links->count() == 0)
									<div class="col-md-12">
										<div class="alert alert-primary" role="alert">{{ label('lbl_no_information') }}	</div>
									</div>
								@else

									<div class="row">

										<div class="col-md-12 col-sm-12">
											<div class="cf nestable-lists">
												<div class="dd" id="nestable" ajax-url="/cms/ajax_menu_update/AboutLink">
													<ol class="dd-list">
														{!! recursiveLinksMenu('0','AboutLink') !!}
													</ol>

												</div>
											</div>
										</div>

									</div>

									@foreach($links as $key => $link)

											<div class="modal fade" id="OpenModelContainer{{ $link->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
									        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
									            <div class="modal-content">
									                <div class="modal-header">
									                    <h5 class="modal-title" id="exampleModalLongTitle"> Update {{ $link->title }} </h5>
									                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									                        <span aria-hidden="true">×</span>
									                    </button>
									                </div>
									                <div class="modal-body">
																		{!! Form::model($link, ['route' => ['cms.about_links.update', $link->id], 'method' => 'PATCH']) !!}

																			@include('cms.about_links._form', ['submitButton' => "Update"])

																		{!! Form::close() !!}

									                </div>
									            </div>
									        </div>
									    </div>
									@endforeach
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
	<!-- [ Main Content ] end -->

@stop

@section('scripts')
	<script src="{!! asset('admin/js/jquery.nestable.js') !!}"></script>
	<script src="{!! asset('admin/js/movable_menu.js') !!}"></script>
	<script src="{!! asset('admin/js/menu.js') !!}"></script>
@stop
