@extends('cms.application')
@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-12">
									<div class="page-header-title">
											<h5 class="m-b-10">Users</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">User Administration</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Users</a></li>
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
							<div class="card-header" > <h5>New User</h5></div>
							<div class="card-body">
								<div class="col-12 px-0">
									<div class="alert alert-info" role="alert">
										* Default Password: <b>Gbt@_678</b>
									</div>
								</div>
								{!! Form::open(['route' => 'cms.users.create-user']) !!}

									@include('cms.users_mgt._form', ['submitButton' => "Save"])

								{!! Form::close() !!}
							</div>
						</div>
					</div>

					<div class="col-md-8">
						<div class="card">
							<div class="card-header" > <h5>Users</h5></div>
							<div class="card-body">
								@if($users->count() == 0)
									<div class="col-md-12">
										<div class="alert alert-primary" role="alert">{{ label('lbl_no_information') }}	</div>
									</div>
								@else
									<table class="table table-hover table-striped dataTable dt-responsive">
										<thead>
											<tr>
												<th>Name</th>
												<th>Email</th>
												<th>Role(s)</th>
												<th>Options</th>
											</tr>
										</thead>

										<tbody>

											@foreach($users as $key => $user)
												<tr>
													<td>{{ $user->name }}</td>
													<td>{{ $user->email }}</td>
													<td >{{ str_replace('"','',json_encode($user->roles->pluck('name'))) }}</td>
													<td>
														{{-- <a href="{{ URL::route('cms.users.user-permissions-form', $user->id) }}" class="label theme-bg2 text-white f-12">View Permission</a> --}}
														{{-- <a href="{{ URL::route('cms.users.user-form', $user->id) }}" class="label theme-bg2 text-white f-12">View Roles</a> --}}
														<a href="{{ URL::route('cms.users.edit-user', $user->id) }}" data-toggle="modal" data-target="#OpenModelContainer{{$key}}" class="label theme-bg2 text-white f-12">Edit</a>
														{!! link_to_route('cms.users.destroy', "Delete", array($user->id), array('data-method' => 'delete', 'data-confirm' => 'Are you Sure' ,'class' => 'label theme-b bg-danger text-white f-12')) !!}
													</td>
												</tr>

												<div class="modal fade" id="OpenModelContainer{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
														<div class="modal-content">
															<div class="modal-header">
																	<h5 class="modal-title" id="exampleModalLongTitle"> Update {{ $user->title }} </h5>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																			<span aria-hidden="true">×</span>
																	</button>
															</div>
															<div class="modal-body">
																{!! Form::model($user, ['route' => ['cms.users.update-user', $user->id], 'method' => 'POST']) !!}

																	@include('cms.users_mgt._form', ['submitButton' => "Update"])

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
