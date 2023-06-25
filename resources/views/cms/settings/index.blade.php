@extends('cms.application')
@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-12">
									<div class="page-header-title">
											<h5 class="m-b-10">Site Settings</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">Settings</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Site Settings</a></li>
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
							<div class="card-header" > <h5>List Of Site Settings</h5></div>
							<div class="card-body">
								@if($settings->count() == 0)
									<div class="col-md-12">
										<div class="alert alert-primary" role="alert">{{ label('lbl_no_information') }}	</div>
									</div>
								@else
									<table class="table table-hover table-striped dataTable">
									<thead>
										<tr>
											<th>Title [ en ]</th>
											<th>Title [ sw ]</th>
											<th>Options</th>
										</tr>
									</thead>

									<tbody>

									@foreach($settings as $key => $link)
										<tr>
											<td>{{ $link->title_en }}</td>
											<td>{{ $link->title_sw }}</td>
											<td>
												<a href="{{ URL::route('cms.related_links.edit', $link->id) }}" data-toggle="modal" data-target="#OpenModelContainer{{ $key }}" class="label theme-bg2 text-white f-12">Edit</a>
												{{-- {!! link_to_route('cms.related_links.destroy', "Delete", array($link->id), array('data-method' => 'delete', 'data-confirm' => 'Are you Sure' ,'class' => 'label theme-b bg-danger text-white f-12')) !!} --}}
											</td>

											<div class="modal fade" id="OpenModelContainer{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
									        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
									            <div class="modal-content">
									                <div class="modal-header">
									                    <h5 class="modal-title" id="exampleModalLongTitle"> Update {{ $link->title }} </h5>
									                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									                        <span aria-hidden="true">×</span>
									                    </button>
									                </div>
									                <div class="modal-body">
																		{!! Form::model($link, ['route' => ['cms.related_links.update', $link->id], 'method' => 'PATCH']) !!}

																			@include('cms.settings._form', ['submitButton' => "Update"])

																		{!! Form::close() !!}

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
	</div>
	<!-- [ Main Content ] end -->

@stop
