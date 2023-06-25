@extends('cms.application')
@section('content')

  <!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-6">
									<div class="page-header-title">
											<h5 class="m-b-10">Regional Offices</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">Settings</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Regional Office</a></li>
									</ul>
							</div>
              <div class="col-md-6 text-right">
                <a href="{{ URL::route('cms.regional_office.create') }}" class="btn btn-info">New Office</a>
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
							<div class="card-header" > <h5>List Of Regional Offices</h5></div>
							<div class="card-body">
								@if($regional_offices->count() == 0)
									<div class="col-md-12">
										<div class="alert alert-primary" role="alert">{{ label('lbl_no_information') }}	</div>
									</div>
								@else
									<table class="table table-hover table-striped dataTable dt-responsive">
									<thead>
										<tr>
											<th>No.</th>
											<th>Name [ en ]</th>
											<th>Name [ sw ]</th>
											<th>Physical Address [ en ]</th>
											<th>Physical Address [ en ]</th>
											<th>Phone</th>
											<th>Fax</th>
											<th>e-mail</th>
											<th>Options</th>
										</tr>
									</thead>

									<tbody>

									@foreach($regional_offices as $key => $regional_office)
										<tr>
											<td>{{ $key + 1 }}</td>
											<td>@php echo	wordwrap($regional_office->name_en,18,"</br>")	@endphp</td>
											<td>@php echo	wordwrap($regional_office->name_sw,18,"</br>")	@endphp</td>
											<td>@php echo	wordwrap($regional_office->physical_address_en,20,"</br>")	@endphp</td>
											<td>@php echo	wordwrap($regional_office->physical_address_sw,20,"</br>")	@endphp</td>

											<td>{{ $regional_office->phone }}</td>
											<td>{{ $regional_office->fax }}</td>
											<td>{{ $regional_office->email }}</td>
											<td>
												<a href="{{ URL::route('cms.regional_office.edit', $regional_office->id) }}" data-toggle="modal" data-target="#OpenModelContainer{{ $key }}" class="label theme-bg2 text-white f-12">View & Edit</a>
												{!! link_to_route('cms.regional_office.destroy', "Delete", array($regional_office->id), array('data-method' => 'delete', 'data-confirm' => 'Are you Sure' ,'class' => 'label theme-b bg-danger text-white f-12')) !!}
											</td>

											<div class="modal fade" id="OpenModelContainer{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
									        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
									            <div class="modal-content">
									                <div class="modal-header">
									                    <h5 class="modal-title" id="exampleModalLongTitle"> Update {{ $regional_office->title }} </h5>
									                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									                        <span aria-hidden="true">×</span>
									                    </button>
									                </div>
									                <div class="modal-body">
														{!! Form::model($regional_office, ['route' => ['cms.regional_office.update', $regional_office->id], 'method' => 'PATCH']) !!}

															@include('cms.regional_office._form', ['submitButton' => "Update"])

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
