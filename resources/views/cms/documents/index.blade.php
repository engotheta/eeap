@extends('cms.application')
@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-12">
									<div class="page-header-title">
											<h5 class="m-b-10">Documents</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">Site Contents</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Documents</a></li>
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
					@if (empty($categories))
						<div class="col-md-12">
							<div class="alert alert-primary" role="alert">Please Add Publication Category First	</div>
						</div>
					@else
						<div class="col-md-4">
							<div class="card">
								<div class="card-header" > <h5>New Document</h5></div>
								<div class="card-body">
									{!! Form::open(['route' => 'cms.publications.index', 'files' => true]) !!}

										@include('cms.publications._form', ['submitButton' => "Save"])

									{!! Form::close() !!}
								</div>
							</div>
						</div>

						<div class="col-md-8">
							<div class="card">
								<div class="card-header" > <h5>List Of Documents</h5></div>
								<div class="card-body">
									@if($publications->count() == 0)
										<div class="col-md-12">
											<div class="alert alert-primary" role="alert">{{ label('lbl_no_information') }}	</div>
										</div>
									@else
										<table class="table table-hover table-striped">
											<thead>
												<tr>
													<th>Name</th>
													<th>Category</th>
													<th>Status</th>
													<th>Published Date</th>
													<th>Options</th>
												</tr>
											</thead>

											<tbody>

												@foreach($publications as $key => $publication)
													<tr>
														<td>@php echo wordwrap($publication->title,25,'<br/>')	@endphp</td>
														@php
															$category_name = App\Models\PublicationCategory::where('id','=',$publication->category_id)->first();
														@endphp
														<td>@php echo (! empty($category_name))? $category_name->title : 'null'	@endphp</td>
														<td>{{ status($publication->active) }}</td>
														<td>{{ $publication->published_date }}</td>
														<td>
															<a href="{{ URL::route('cms.publications.edit', $publication->id) }}" data-toggle="modal" data-target="#OpenModelContainer{{ $key }}" class="label theme-bg2 text-white f-12">Edit</a>
															{!! link_to_route('cms.publications.destroy', "Delete", array($publication->id), array('data-method' => 'delete', 'data-confirm' => 'Are you Sure' ,'class' => 'label theme-b bg-danger text-white f-12')) !!}
														</td>

														<div class="modal fade" id="OpenModelContainer{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
												        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
												            <div class="modal-content">
												                <div class="modal-header">
												                    <h5 class="modal-title" id="exampleModalLongTitle"> Update <b>{{ $publication->title }}</b> </h5>
												                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
												                        <span aria-hidden="true">×</span>
												                    </button>
												                </div>
												                <div class="modal-body">
																					{!! Form::model($publication, ['route' => ['cms.publications.update', $publication->id], 'method' => 'PATCH']) !!}

																						@include('cms.publications._form', ['submitButton' => "Update"])

																					{!! Form::close() !!}

												                </div>
												            </div>
												        </div>
												    	</div>
													</tr>
												@endforeach
											</tbody>
										</table>
										<div class="row justify-content-center">
											{{-- {!! $publications->render() !!} --}}
										</div>
									@endif
								</div>
							</div>
						</div>
					@endif
				</div>
			</div>
	</div>
	<!-- [ Main Content ] end -->

@stop
