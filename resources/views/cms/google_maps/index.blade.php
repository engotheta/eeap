@extends('cms.application')
@section('content')
  <!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-7">
									<div class="page-header-title">
											<h5 class="m-b-10">Google Map</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">Settings</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Site Settings</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Google Map</a></li>
									</ul>
							</div>

							<div class="col-md-5 text-right">
								<a href="{{ url('/cms/googlemaps/create')}}" class="btn btn-primary"> <i class="feather icon-edit"></i> Create Google Map</a>
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
						<div class="card-header" > <h5>List of Google Maps</h5></div>
						<div class="card-body">
							@if($google_maps->count() == 0)

								<div class="col-md-12">
									<div class="alert alert-primary" role="alert">{{ label('lbl_no_information') }}	</div>
								</div>
							@else

								<table class="table table-strip no-pg-dataTable dataTable" style="100%">
									<thead>
										<tr>
											<th>S/N</th>
											<th>Regional Office</th>
											<th>Map</th>
											<th>Option</th>
										</tr>
									</thead>

									<tbody>

									@foreach($google_maps as $key => $google_map)
										<tr class="shadow-on-hover">
											<td>{{ $key+1 }}</td>
											<td><strong>@php echo	wordwrap($google_map->office->name,60,"</br>")	@endphp  </strong></td>
											<td> <a href="#" data-toggle="modal" data-target="#OpenMapModal-{{$key}}"> View Map </a></a> </td>
											<td>
												<a href="{{ URL::route('cms.googlemaps.edit', $google_map->id) }}" class="label theme-bg2 text-white f-12">Edit</a>
												{!! link_to_route('cms.googlemaps.destroy', "delete", array($google_map->id), array('data-method' => 'delete', 'data-confirm' => 'Are you Sure' ,'class' => 'label theme-b bg-danger text-white f-12')) !!}
											</td>
										</tr>

										<div class="modal fade" id="OpenMapModal-{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLongTitle">  {{$google_map->office->name}} MAP </h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">×</span>
														</button>
													</div>
													<div class="modal-body">
														<div class="card-body">
															{!! $google_map->url !!}
													  </div>
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
