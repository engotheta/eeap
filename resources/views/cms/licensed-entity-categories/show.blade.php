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
											<h5 class="m-b-10">{{ $selected_category->title}}'s Licensed Entities</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">Site Contents</a></li>
											<li class="breadcrumb-item"><a href="{{ url('/cms/licensed-entity-categories') }}">Licensed Entities</a></li>
											<li class="breadcrumb-item"><a href="javascript:">{{ $selected_category->title}}</a></li>
									</ul>
							</div>
				
							<div class="col-md-5 text-right">
								<a href="#" data-toggle="modal" data-target="#newDocumentUpload" class="btn btn-primary mx-2">
									<i class="feather icon-add"></i> Import 
								</a>

								<a href="#" data-toggle="modal" data-target="#newDocument" class="btn btn-primary">
									<i class="feather icon-add"></i> Add {{ $selected_category->title}}
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
					<div class="col-md-3">
						<div class="row">
							<div class="col-12">
								<a href="{{ URL::route('cms.licensed-entity-categories.create') }}" data-toggle="modal" data-target="#newCategory" class="btn btn-outline-primary col-12 ">
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

											@foreach($categories as $key => $category)
												<tr class="hover-show">
													<td>
														<a class=" {{($category->active ==1)? 'text-dark': 'text-danger'}}" href="{{ URL::route('cms.licensed-entity-categories.show', $category->slug) }}">

																	{{ $category->title_en }} <br>
																	<small>{{ number_format(count($category->licensedEntities)) }} Entities</small>
																	<a href="{{ URL::route('cms.licensed-entity-categories.edit', $category->id) }}"
																		data-toggle="modal" data-target="#OpenModelContainer{{ $key }}"
																		class="px-1 show-on-hover" >
																		<i class="feather icon-edit"></i>
																	</a>
																	<a href="{{ URL::route('cms.licensed-entity-categories.destroy', $category->id) }}"
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

						{{-- modals --}}
						@foreach($categories as $key => $category)

							<div class="modal fade" id="OpenModelContainer{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
											<div class="modal-content">
													<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLongTitle"> <b>Update {{ $category->title }}</b> </h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">×</span>
															</button>
													</div>
													<div class="modal-body">
														{!! Form::model($category, ['route' => ['cms.licensed-entity-categories.update', $category->id], 'method' => 'PATCH' ,'class'=>'loading-form']) !!}
															@include('cms.licensed-entity-categories._form', ['submitButton' => "Update"])
														{!! Form::close() !!}
													</div>
											</div>
									</div>
							</div>
							
						@endforeach
						{{-- /modals --}}
					</div>

					<div class="col-md-9 ">
						<div class="card " >
							<div class="card-header" > <h5>List Of {{$selected_category->title}} </h5></div>
							<div class="card-body position-relative" style="overflow:auto;height:70vh">
								<div class="position-absolute loader h-100 w-100" id="entitiesLoader" style="z-index:9999; background:rgba(255, 255, 255, 0.7)">
									<div class="d-flex justify-content-center align-items-center h-100 w-100">
										<div class="loader-11 position-relative" style="top:0px !important"></div>
									</div>
							 	</div>

								@if($selected_category->licensedEntities->count() == 0)
									<div class="col-md-12">
										<div class="alert alert-primary" role="alert">{{ label('lbl_no_information') }}	</div>
									</div>
								@else
									<table class="table table-hover table-striped dataTable">
									<thead>
										<tr>
											<th></th>
											<th>Name</th>
											{{-- <th>Status</th> --}}
											<th>Region</th>
											<th>Options</th>
										</tr>
									</thead>

									<tbody>

									@foreach($selected_category->licensedEntities as $key => $entity)
										<tr>
											<td>{{ $key + 1}}</td>
											<td>@php echo	wordwrap($entity->name,40,"</br>")	@endphp</td>
											{{-- <td>@if ($entity->active ==1) Active @else in Active	@endif</td> --}}
											<td>@php echo	wordwrap($entity->region,40,"</br>")	@endphp</td>
											<td>
												<a href="{{ URL::route('cms.licensed-entities.edit', $entity->id) }}" data-toggle="modal" data-target="#OpenDocumentModel{{ $key }}" class="label theme-bg2 text-white f-12">View & Edit</a>
												{!! link_to_route('cms.licensed-entities.destroy', "Delete", array($entity->id), array('data-method' => 'delete', 'data-confirm' => 'Are you Sure' ,'class' => 'label theme-b bg-danger text-white f-12')) !!}
											</td>

											<div class="modal fade" id="OpenDocumentModel{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width:680px">
															<div class="modal-content">
																	<div class="modal-header">
																			<h5 class="modal-title" id="exampleModalLongTitle"> <b>{{ $selected_category->title}} |  Update </b> </h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																					<span aria-hidden="true">×</span>
																			</button>
																	</div>
																	<div class="modal-body">
																		<div class="row">
																			<div class="col-md-12">
																				{!! Form::model($entity, ['route' => ['cms.licensed-entities.update', $entity->id],'files'=>true, 
																				'method' => 'PATCH' ,'class'=>'loading-form']) !!}
																					@include('cms.licensed-entity-categories._licensed-entity_form', ['submitButton' => "Update"])
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
											<h5 class="modal-title" id="exampleModalLongTitle"> <b>New Licensed Entity Category</b> </h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">×</span>
											</button>
									</div>
									<div class="modal-body">
										{!! Form::open(['route' => 'cms.licensed-entity-categories.index' ,'class'=>'loading-form']) !!}
											@include('cms.licensed-entity-categories._form', ['submitButton' => "Save"])
										{!! Form::close() !!}

									</div>
							</div>
					</div>
			</div>

			<div class="modal fade" id="newDocumentUpload" tabindex="-1" role="dialog" aria-labelledby="newDocumentUpload" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
							<div class="modal-content">
									<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLongTitle"> <b>Import {{ $selected_category->title}}</b> </h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">×</span>
											</button>
									</div>
									<div class="modal-body px-3">
										<form action="{{url('cms/licensed-entities-upload')}}" id="uploadEntityForm" method="POST" enctype="multipart/form-data">
												@csrf
												<div class="col-12 form-group">
													{!! Form::label('file', 'Import from Excel (use defined template)') !!}
													{!! Form::file('file',['class'=>'form-control','accept'=> '.xls,.xlsx']) !!}
												</div>

												
												<div class="col-12  form-group">
													{!! Form::label('clear_available', 'Delete previous '.$selected_category->title) !!}
													{!! Form::select('clear_available', 
													array('1' => 'YES, DELETE and only use imported','0'=>'NO, Append imported to the old ones')
													,0,['class'=>'form-control']) !!}
												</div>

												<div class="col-12 form-group" style="display:none">
													{!! Form::label('category_id', 'Publication Category') !!}
													{!! Form::text('category_id',$selected_category->id,['class'=>'form-control']) !!}
												</div> 
										
												<hr class="my-3">

												<div class="col-12 form-group">
													{!! Form::submit('Import', ['class' => 'btn btn-primary col-md-12']) !!}
												</div>
										</form>
									</div>
							</div>
					</div>
			</div>

			<div class="modal fade" id="newDocument" tabindex="-1" role="dialog" aria-labelledby="newDocument" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
							<div class="modal-content">
									<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLongTitle"> <b>New {{ $selected_category->title}}</b> </h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">×</span>
											</button>
									</div>
									<div class="modal-body px-3">
										{!! Form::open(['route' => 'cms.licensed-entities.index','files'=>false ,'class'=>'loading-form']) !!}
											@include('cms.licensed-entity-categories._licensed-entity_form', ['submitButton' => "Save"])
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
