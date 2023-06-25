@extends('cms.application')
@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-7">
									<div class="page-header-title">
											<h5 class="m-b-10">Quote</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">Site Contents</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Informations</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Quotes</a></li>
									</ul>
							</div>

							<div class="col-md-5 text-right">
									<a href="{{ url('/cms/quotes/create')}}" class="btn btn-primary"> <i class="feather icon-edit"></i> Create Quote</a>
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
							<div class="card-header" > <h5>Quotes</h5></div>
							<div class="card-body">
								@if($quotes->count() == 0)

									<div class="col-md-12">
										<div class="alert alert-primary" role="alert">{{ label('lbl_no_information') }}	</div>
									</div>
								@else

									<table class="table table-strip no-pg-dataTable" style="100%">
										<thead>
											<tr>
												<th>Photo</th>
												<th>Title</th>
												<th>Created On</th>
												<th>Status</th>
												<th>Option</th>
											</tr>
										</thead>

										<tbody>

										@foreach($quotes as $key => $quote)
											<tr class="shadow-on-hover">
												<td>
													<img src="{{ url('/uploads/quotes/'.$quote->photo_url) }}" style="max-height:40px !important;">
												</td>
												<td><strong>@php echo	wordwrap($quote->title,60,"</br>")	@endphp  </strong></td>
												<td><strong>{{ date_format(date_create($quote->created_at), 'dS M Y, H:i:s') }}</strong></td>
												<td><strong>@if ($quote->active) Published @else UnPublished @endif</strong><br/></td>
												<td>
													<a href="{{ URL::route('cms.quotes.edit', $quote->id) }}" class="label theme-bg2 text-white f-12">View & Edit</a>
													{!! link_to_route('cms.quotes.destroy', "delete", array($quote->id), array('data-method' => 'delete', 'data-confirm' => 'Are you Sure' ,'class' => 'label theme-b bg-danger text-white f-12')) !!}
												</td>
											</tr>
										@endforeach
										</tbody>
									</table>

									<div class="row justify-content-center">
										{!! $quotes->render() !!}
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
