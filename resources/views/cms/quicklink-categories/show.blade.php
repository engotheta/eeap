@extends('cms.application')

@section('stylesheets')
	<style media="screen">
		body{
			overflow: hidden;
		}
		.ega-header{
			position: fixed !important;
		}
		.ega-main-container{
			margin-top: 20px !important;
		}
		.table-fixed{
			height: 100vh;
			overflow: auto;
			position: fixed;
			width: 60%;
			right: 15px;
		}
	</style>
@stop

@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-7">
								<div class="page-header-title">
										<h5 class="m-b-10">{{ $category->title}}</h5>
								</div>
								<ul class="breadcrumb">
										<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
										<li class="breadcrumb-item"><a href="javascript:">Site Contents</a></li>
										<li class="breadcrumb-item"><a href="{{ url('/cms/quicklink-categories') }}">Quicklinks</a></li>
										<li class="breadcrumb-item"><a href="javascript:">{{ $category->title}}</a></li>
								</ul>
							</div>

							<div class="col-md-5 text-right">
									<a href="#" data-toggle="modal" data-target="#newDocument" class="btn btn-primary">
										<i class="fas fa-plus"></i> Add {{ $category->title }}
									</a>
							</div>
					</div>
			</div>
	</div>
	<div class="modal fade" id="newDocument" tabindex="-1" role="dialog" aria-labelledby="newCategory" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
						<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle"> <b>New {{ $category->title }}</b> </h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
								</button>
						</div>
						<div class="modal-body">
							{!! Form::open(['route' => 'cms.quick_links.index','files'=>true]) !!}

								@include('cms.quicklink-categories._quicklink_form', ['submitButton' => "Save"])

							{!! Form::close() !!}

						</div>
				</div>
		</div>
	</div>
	<!-- [ breadcrumb ] end -->

	<!-- [ Main Content ] start -->
	<div class="main-body">
			<div class="page-wrapper">

				<div class="row">
					<div class="col-md-3">
						<div class="row">
							<div class="col-12">
								<a href="{{ URL::route('cms.quicklink-categories.create') }}" data-toggle="modal" data-target="#newCategory" class="btn btn-outline-primary col-12 ">
									<i class="feather icon-plus-square"></i> New Category
								</a>
							</div>

							<div class="col-12 custom-fixed" id="scrollbar">
								@if($categories->count() == 0)
									<div class="col-md-12">
										<div class="alert alert-primary" role="alert">{{ label('lbl_no_information') }}	</div>
									</div>
								@else
									<table class="table table-hover">

										<tbody>

											@foreach($categories as $key => $quicklinkCategory)
												<tr class="hover-show">
													<td>
														<a class=" {{($quicklinkCategory->active ==1)? 'text-dark': 'text-danger'}}" href="{{ URL::route('cms.quicklink-categories.show', $quicklinkCategory->slug) }}">

																	{{ $quicklinkCategory->title_en }} <br>
																	<small>{{ number_format(count($quicklinkCategory->quicklinks)) }} Quicklinks</small>
																	<a href="{{ URL::route('cms.quicklink-categories.edit', $quicklinkCategory->id) }}"
																		class="px-1 show-on-hover" data-toggle="modal" data-target="#OpenModelContainer{{ $key }}">
																		<i class="feather icon-edit"></i>
																	</a>
																	<a href="{{ URL::route('cms.quicklink-categories.destroy', $quicklinkCategory->id) }}"
																		data-method = 'delete' class="px-1 show-on-hover" >
																		<i class="feather icon-trash-2 text-danger"></i>
																	</a>

														</a>
													</td>

												</tr>
											@endforeach
										</tbody>
								</table>
								@endif
							</div>
						</div>

						 {{-- modals  --}}
						@foreach($categories as $key => $quicklinkCategory)

							<div class="modal fade" id="OpenModelContainer{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
											<div class="modal-content">
													<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLongTitle"> <b>Update {{ $quicklinkCategory->title }}</b> </h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">×</span>
															</button>
													</div>
													<div class="modal-body">
														{!! Form::model($quicklinkCategory, ['route' => ['cms.quicklink-categories.update', $quicklinkCategory->id], 'method' => 'PATCH']) !!}

															@include('cms.quicklink-categories._form', ['submitButton' => "Update"])

														{!! Form::close() !!}

													</div>
											</div>
									</div>
							</div>
						@endforeach
						{{-- modals  --}}
					</div>

					<div class="col-md-9">
						<div class="card" >
							<div class="card-header" > <h5>List Of {{$category->title}} </h5></div>
							<div class="card-body" style="overflow:auto;height:70vh">
								@if($category->quicklinks->count() == 0)
									<div class="col-md-12">
										<div class="alert alert-primary" role="alert">{{ label('lbl_no_information') }}	</div>
									</div>
								@else
									<table class="table table-hover table-striped dataTable">
									<thead>
										<tr>
											<th></th>
											<th>Title</th>
											<th>Status</th>
											<th>Options</th>
										</tr>
									</thead>

									<tbody>

									@foreach($category->quicklinks as $key => $quicklink)
										<tr>
											<td>{{ $key + 1}}</td>
											<td>@php echo	wordwrap($quicklink->title,60,"</br>")	@endphp</td>
											<td>@if ($quicklink->active ==1) Active @else InActive	@endif</td>
											<td>
												<a href="{{ URL::route('cms.quick_links.edit', $quicklink->id) }}" data-toggle="modal" data-target="#OpenDocumentModel{{ $key }}" class="label theme-bg2 text-white f-12">View & Edit</a>
												{!! link_to_route('cms.quick_links.destroy', "Delete", array($quicklink->id), array('data-method' => 'delete', 'data-confirm' => 'Are you Sure' ,'class' => 'label theme-b bg-danger text-white f-12')) !!}
											</td>

											<div class="modal fade" id="OpenDocumentModel{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width:85%">
															<div class="modal-content">
																	<div class="modal-header">
																			<h5 class="modal-title" id="exampleModalLongTitle"> <b>{{ $category->title}} | Update</b> </h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																					<span aria-hidden="true">×</span>
																			</button>
																	</div>
																	<div class="modal-body">
																		<div class="row">
																			{{-- <div class="col-md-6">
																					<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
																						<li class="nav-item">
																						<a class="nav-link active" id="pills-home-tab" data-toggle="pill"
																							href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">English Quicklink</a>
																						</li>

																						<li class="nav-item">
																							<a class="nav-link"
																							id="pills-profile-tab" data-toggle="pill"
																							href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Swahili Quicklink</a>
																						</li>
																					</ul>

																					<div class="tab-content" id="pills-tabContent">
																						<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
																							<iframe src="{{asset('uploads/quicklinks/'.$quicklink->file_en)}}" width="100%" height="400px"></iframe>
																						</div>
																						<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
																							<iframe src="{{asset('uploads/quicklinks/'.$quicklink->file_sw)}}" width="100%" height="400px"></iframe>
																						</div>
																					</div>

																			</div> --}}
																			<div class="col-12">
																				{!! Form::model($quicklink, ['route' => ['cms.quick_links.update', $quicklink->id],'files'=>true, 'method' => 'PATCH']) !!}

																					@include('cms.quicklink-categories._quicklink_form', ['submitButton' => "Update"])

																				{!! Form::close() !!}
																			</div>
																		</div>

																	</div>
															</div>
													</div>
											</div>

										</tr>
									@endforeach
									</tbody>
								</table>
								@endif
							</div>
						</div>
					</div>

				</div>

			</div>

			<div class="modal fade" id="newCategory" tabindex="-1" role="dialog" aria-labelledby="newCategory" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
							<div class="modal-content">
									<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLongTitle"> <b>New Quicklink Category</b> </h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">×</span>
											</button>
									</div>
									<div class="modal-body">
										{!! Form::open(['route' => 'cms.quicklink-categories.index']) !!}

											{{-- @include('cms.includes.cropimage',['img' => '','aspectRatio'=> 11 / 4]) --}}
											@include('cms.quicklink-categories._form', ['submitButton' => "Save"])

										{!! Form::close() !!}

									</div>
							</div>
					</div>
			</div>


			
	</div>
	<!-- [ Main Content ] end -->

@stop

@section('scripts')

@stop
