@extends('cms.application')
@section('content')

  <!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-7">
									<div class="page-header-title">
											<h5 class="m-b-10">Special Pages</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">Site Contents</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Special Pages</a></li>
									</ul>
							</div>

              <div class="col-md-5 text-right">
									<a href="{{ url('/cms/special-pages/create')}}" class="btn btn-primary">
										<i class="feather icon-edit"></i> Create New Special Page
									</a>
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
							<div class="card-header" > <h5>List Of Special Pagess</h5></div>
							<div class="card-body">
								@if($pages->count() == 0)
									<div class="col-md-12">
										<div class="alert alert-primary" role="alert">{{ label('lbl_no_information') }}	</div>
									</div>
								@else
									<table class="table table-hover table-striped dataTable">
									<thead>
										<tr>
											<th>Title</th>
											<th>Status</th>
											<th>Options</th>
										</tr>
									</thead>

									<tbody>

									@foreach($pages as $key => $page)
										<tr>
											<td>@php echo	wordwrap($page->title_en,60,"</br>")	@endphp</td>
											{{-- <td>@php echo	wordwrap($page->title_sw,60,"</br>")	@endphp</td> --}}
											<td>@if ($page->status == 1) Active @else In Active  @endif</td>
											<td>
												<a href="{{ URL::route('cms.special-pages.edit', $page->id) }}" class="label theme-bg2 text-white f-12">View & Edit</a>
												{!! link_to_route('cms.special-pages.destroy', "Delete", array($page->id), array('data-method' => 'delete', 'data-confirm' => 'Are you Sure' ,'class' => 'label theme-b bg-danger text-white f-12')) !!}
											</td>
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
