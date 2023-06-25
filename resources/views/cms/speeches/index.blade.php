@extends('cms.application')
@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-7">
									<div class="page-header-title">
											<h5 class="m-b-10">Speeches</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											{{-- <li class="breadcrumb-item"><a href="javascript:">Site Contents</a></li> --}}
											<li class="breadcrumb-item"><a href="javascript:">Informations</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Speeches</a></li>
									</ul>
							</div>

							<div class="col-md-5 text-right">
									<a href="{{ url('/cms/speeches/create')}}" class="btn btn-primary">Create Speeches</a>
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
							<div class="card-header" > <h5>List Of Speeches</h5></div>
							<div class="card-body">
								@if($speeches->count() == 0)

									<div class="col-md-12">
										<div class="alert alert-primary" role="alert">{{ label('lbl_no_information') }}	</div>
									</div>
								@else

									<table class="table table-strip no-pg-dataTable dataTable" style="100%">
										<thead>
											<tr>
												<th>No.</th>
												<th>Title</th>
												<th>Created On</th>
												<th>Status</th>
												<th>Option</th>
											</tr>
										</thead>

										<tbody>

										@foreach($speeches as $key => $speech)
											<tr class="shadow-on-hover">
												<td>{{ $key + 1}}</td>
												<td><strong>@php echo	wordwrap($speech->name,60,"</br>")	@endphp  </strong></td>
												<td><strong>{{ date_format(date_create($speech->created_at), 'dS M Y, H:i:s') }}</strong></td>
												<td><strong>@if ($speech->active) Published @else UnPublished @endif</strong><br/></td>
												<td>
													<a href="{{ URL::route('cms.speeches.edit', $speech->id) }}" class="label theme-bg2 text-white f-12">View & Edit</a>
													{!! link_to_route('cms.speeches.destroy', "delete", array($speech->id), array('data-method' => 'delete', 'data-confirm' => 'Are you Sure' ,'class' => 'label theme-b bg-danger text-white f-12')) !!}
												</td>
											</tr>
										@endforeach
										</tbody>
									</table>

									<div class="row justify-content-center">
										{{-- {!! $speeches->render() !!} --}}
									</div>
								@endif

							</div>
						</div>
					</div>

				</div>
			</div>
	</div>
	<!-- [ Main Content ] end -->

@stop
