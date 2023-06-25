@extends('cms.application')
@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-7">
									<div class="page-header-title">
											<h5 class="m-b-10">Homepage Informations</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">Site Contents</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Informations</a></li>
											<li class="breadcrumb-item"><a href="javascript:">{{ label('lbl_more_info') }}</a></li>
									</ul>
							</div>

							<div class="col-md-5 text-right">
									<a href="{{ url('/cms/more-infos/create')}}" class="btn btn-primary"> <i class="feather icon-edit"></i> Create Info</a>
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
							<div class="card-header" > <h5>{{ label('lbl_more_info') }}</h5></div>
							<div class="card-body">
								@if($moreInfos->count() == 0)

									<div class="col-md-12">
										<div class="alert alert-primary" role="alert">{{ label('lbl_no_information') }}	</div>
									</div>
								@else

									<table class="table table-strip no-pg-dataTable dataTable" style="100%">
										<thead>
											<tr>
												<th>Photo</th>
												<th>Contents For</th>
												{{-- <th>Title</th> --}}
												<th>Status</th>
												<th>Option</th>
											</tr>
										</thead>

										<tbody>

										@foreach($moreInfos as $key => $moreInfo)
											<tr class="shadow-on-hover">
												<td> 
													@if(isset($moreInfo->photo_url))
													<img loading="lazy" src="{{ url('/uploads/more-infos/'.$moreInfo->photo_url) }}" style="max-height:40px !important;">
													@endif
												</td>
												{{-- <td><strong>{{ $moreInfo->item_name }}</strong></td> --}}
												<td><strong>@php echo	wordwrap($moreInfo->title,40,"</br>")	@endphp  </strong></td>
												<td><strong>@if ($moreInfo->active) Active @else Inactive @endif</strong><br/></td>
												<td>
													<a href="{{ URL::route('cms.more-infos.edit', $moreInfo->id) }}" class="label theme-bg2 text-white f-12">View & Edit</a>
													{!! link_to_route('cms.more-infos.destroy', "delete", array($moreInfo->id), array('data-method' => 'delete', 'data-confirm' => 'Are you Sure' ,'class' => 'label theme-b bg-danger text-white f-12')) !!}
												</td>
											</tr>
										@endforeach
										</tbody>
									</table>

									<div class="row justify-content-center">
										{{-- {!! $moreInfos->render() !!} --}}
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
