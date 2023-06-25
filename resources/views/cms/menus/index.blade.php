@extends('cms.application')
@section('content')
  <!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-12">
									<div class="page-header-title">
											<h5 class="m-b-10">Menu</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">Customization</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Menu</a></li>
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
{{-- 
					<div class="col-md-4">
						<div class="card">
							<div class="card-header" > <h5>New Menu</h5></div>
							<div class="card-body">
              			  {!! Form::open(['route' => 'cms.menu.index']) !!}
        					@include('cms.menus._form', ['submitButton' => "Save"])
        					{!! Form::close() !!}
							</div>
						</div>
					</div> --}}

					<div class="col-md-888 col-12">
						<div class="card">
							<div class="card-header" > <h5>List Of Menu</h5></div>
							<div class="card-body">
								@if($menus->count() == 0)
									<div class="col-md-12">
										<div class="alert alert-primary" role="alert">{{ label('lbl_no_information') }}	</div>
									</div>
								@else
									<table class="table table-hover table-striped dataTable">
									<thead>
										<tr>
											<th>Name</th>
											<th>Category</th>
											<th>Status</th>
											<th>Options</th>
										</tr>
									</thead>

									<tbody>

									@foreach($menus as $key => $menu)
										<tr>
											<td>{{ $menu->title }}</td>
											<td>
												@if ($menu->category == 'main_nav') Main Menu
												@elseif($menu->category == 'footer_menu') Footer Menu
												@elseif($menu->category == 'top_menu') Top Menu
												@else {{$menu->category}}  @endif</td>
											<td>@if ($menu->status) Active @else In-Active  @endif</td>
											<td>
												<a href="{{ URL::route('cms.menu-items.index', $menu->id) }}" class="label bg-info text-white f-12">View Items</a>
												{{-- <a href="{{ URL::route('cms.menu.edit', $menu->id) }}" data-toggle="modal" data-target="#OpenModelContainer{{$key}}" class="label theme-bg2 text-white f-12">Edit</a>
												{!! link_to_route('cms.menu.destroy', "Delete", array($menu->id), array('data-method' => 'delete', 'data-confirm' => 'Are you Sure' ,'class' => 'label theme-b bg-danger text-white f-12')) !!} --}}
											</td>

											<div class="modal fade" id="OpenModelContainer{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
									        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
									            <div class="modal-content">
									                <div class="modal-header">
									                    <h5 class="modal-title" id="exampleModalLongTitle"> Update {{ $menu->title }} </h5>
									                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									                        <span aria-hidden="true">×</span>
									                    </button>
									                </div>
									                <div class="modal-body">

															{!! Form::model($menu, ['route' => ['cms.menu.update', $menu->id], 'method' => 'PATCH']) !!}

																@include('cms.menus._form', ['submitButton' => "Update"])

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
