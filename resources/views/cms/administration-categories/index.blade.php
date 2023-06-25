@extends('cms.application')
@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-12">
									<div class="page-header-title">
											<h5 class="m-b-10">Administration Categories</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">User Administration</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Administration Categories</a></li>
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
							<div class="card-header" > <h5>New Administration Category</h5></div>
							<div class="card-body">
								{!! Form::open(['route' => 'cms.administration_categories.index']) !!}

									@include('cms.administration-categories._form', ['submitButton' => "Save"])

								{!! Form::close() !!}
							</div>
						</div>
					</div>

					<div class="col-md-8">
						<div class="card">
							<div class="card-header" > <h5>List Of Administration Categories</h5></div>
							<div class="card-body">
								@if($categories->count() == 0)
									<div class="col-md-12">
										<div class="alert alert-primary" role="alert">{{ label('lbl_no_information') }}	</div>
									</div>
								@else
									<table class="table table-hover table-striped dataTable">
									<thead>
										<tr>
											<th>Title</th>
											<th>Options</th>
										</tr>
									</thead>

									<tbody>

										@foreach($categories as $key => $category)
											<tr>
												<td>{{ $category->title_en }}</td>
												<td>
													<a href="{{ URL::route('cms.administration_categories.show', $category->id) }}" class="label theme-bg2 text-white f-12">View Members</a>
													<a href="{{ URL::route('cms.administration_categories.edit', $category->id) }}" data-toggle="modal" data-target="#OpenModelContainer{{ $key }}" class="label theme-bg2 text-white f-12">Edit</a>
											  	{{-- id one is used on home page --}}
													@if(!$category->featured)
														{!! link_to_route('cms.administration_categories.destroy', "Delete", array($category->id), array('data-method' => 'delete', 'data-confirm' => 'Are you Sure' ,'class' => 'label theme-b bg-danger text-white f-12')) !!}
													@endif
												</td>
											</tr>

											<div class="modal fade" id="OpenModelContainer{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
										        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
										            <div class="modal-content">
										                <div class="modal-header">
										                    <h5 class="modal-title" id="exampleModalLongTitle"> Update {{ $category->title }} </h5>
										                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										                        <span aria-hidden="true">×</span>
										                    </button>
										                </div>
										                <div class="modal-body">
															{!! Form::model($category, ['route' => ['cms.administration_categories.update', $category->id], 'method' => 'PATCH']) !!}

																@include('cms.administration-categories._form', ['submitButton' => "Update"])

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

@section('scripts')
	<script type="text/javascript">

	</script>
@stop
