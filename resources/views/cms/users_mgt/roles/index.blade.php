@extends('cms.application')
@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-12">
									<div class="page-header-title">
											<h5 class="m-b-10">CMS Roles </h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">User Administration</a></li>
											<li class="breadcrumb-item"><a href="javascript:">CMS Roles </a></li>
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
					<div class="col-md-4">
						<div class="card">
							<div class="card-header" > <h5>New CMS Roles </h5></div>
							<div class="card-body">
								{!! Form::open(['route' => 'cms.roles.index', 'files' => true]) !!}

									@include('cms.users_mgt.roles._form', ['submitButton' => "Save"])

								{!! Form::close() !!}
							</div>
						</div>
					</div>

					<div class="col-md-8">
						<div class="card">
							<div class="card-header" > <h5>CMS Roles </h5></div>
							<div class="card-body">
								@if($roles->count() == 0)
									<div class="col-md-12">
										<div class="alert alert-primary" role="alert">{{ label('lbl_no_information') }}	</div>
									</div>
								@else
									<table class="table table-hover table-striped dataTable dt-responsive">
										<thead>
											<tr>
												<th>Name</th>
												<th>Display Name</th>
												<th>Description</th>
												<th>Options</th>
											</tr>
										</thead>

										<tbody>

											@foreach($roles as $key => $role)
												<tr>
													<td>{{ $role->name }}</td>
													<td>{{ $role->display_name }}</td>
													<td>{{ $role->description }}</td>
													<td>
														<a href="{{ URL::route('cms.users.user-permissions-form', $role->id) }}" class="label theme-bg2 text-white f-12">Permissions</a>
														<a href="{{ URL::route('cms.roles.edit', $role->id) }}" data-toggle="modal" data-target="#OpenModelContainer{{ $key}}" class="label theme-bg2 text-white f-12">Edit</a>
														{!! link_to_route('cms.roles.destroy', "Delete", array($role->id), array('data-method' => 'delete', 'data-confirm' => 'Are you Sure' ,'class' => 'label theme-b bg-danger text-white f-12')) !!}
													</td>
												</tr>

												<div class="modal fade" id="OpenModelContainer{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
															<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
																	<div class="modal-content">
																			<div class="modal-header">
																					<h5 class="modal-title" id="exampleModalLongTitle"> Update {{ $role->name }} </h5>
																					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																							<span aria-hidden="true">×</span>
																					</button>
																			</div>
																			<div class="modal-body">

																				{!! Form::model($role, ['route' => ['cms.roles.update', $role->id], 'files' => true, 'method' => 'PATCH']) !!}

																					@include('cms.users_mgt.roles._form', ['submitButton' => "Update"])

																				{!! Form::close() !!}

																			</div>
																	</div>
															</div>
													</div>
											@endforeach
										</tbody>
									</table>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
	<!-- [ Main Content ] end -->

@stop
