@extends('cms.application')
@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-7">
									<div class="page-header-title">
											<h5 class="m-b-10">Product Categories</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">{{label('lbl_site_title_short')}} Details</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Product Categories</a></li>
									</ul>
							</div>

							<div class="col-md-5 text-right">
									<a href="{{ url('/cms/product_categories/create')}}" class="btn btn-primary">Create Product Category</a>
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
							<div class="card-header"> <h5>List Of Product Categories</h5></div>
							<div class="card-body">
								<div class="p-2 mb-3 bg-light">
									<span class="text-danger">NOTE: Deleting a Category will delete all products associated with it.</span>
								</div>
								@if($categories->count() == 0)

									<div class="col-md-12">
										<div class="alert alert-primary" role="alert">{{ label('lbl_no_information') }}	</div>
									</div>
								@else

									<table class="table table-strip no-pg-dataTable dataTable" style="100%">
										<thead>
											<tr>
												<th>No.</th>
												<th>Title</th>
												<th>Products</th>
												<th>Created On</th>
												<th>Status</th>
												<th>Options</th>
											</tr>
										</thead>

										<tbody>

										@foreach($categories as $key => $category)
											<tr class="shadow-on-hover">
												<td>{{ $key + 1}}</td>
												<td><strong>@php echo	wordwrap($category->title,60,"</br>")	@endphp  </strong></td>
												<td><strong> {{ $category->products_count }} </strong></td>
												<td><strong>{{ date_format(date_create($category->created_at), 'dS M Y, H:i:s') }}</strong></td>
												<td><strong>@if ($category->active) Published @else UnPublished @endif</strong><br/></td>
												<td>
													<a href="{{ URL::route('cms.product_categories.edit', $category->id) }}" class="label theme-bg2 text-white f-12">View & Edit</a>
													{!! link_to_route('cms.product_categories.destroy', "delete", array($category->id), array('data-method' => 'delete', 'data-confirm' => 'Are you Sure' ,'class' => 'label theme-b bg-danger text-white f-12')) !!}
												</td>
											</tr>
										@endforeach
										</tbody>
									</table>

									{{-- <div class="row justify-content-center">
										{!! $categories->render() !!}
									</div> --}}
								@endif

							</div>
						</div>
					</div>

				</div>
			</div>
	</div>
	<!-- [ Main Content ] end -->

@stop
