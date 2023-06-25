@section('stylesheets')
	<link rel="stylesheet" href="{{ asset('admin/css/movable_menu.css') }}" >
@stop
@extends('cms.application')
@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-7">
									<div class="page-header-title">
											<h5 class="m-b-10">Menu Items</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">Site Contents</a></li>
											<li class="breadcrumb-item"><a href="{{ url('/cms/menu') }}">Menu</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Menu Items</a></li>
									</ul>
							</div>
							<div class="col-md-5 text-right text-capitalize" id="nestable-menu">

									<button class="btn btn-outline-primary btn-sm m-r-10" data-action="expand-all">Expand All</button>
									<button class="btn btn-outline-secondary btn-sm" data-action="collapse-all">Collapse All</button>

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
							<div class="card-header" >
								<h5>New Menu Items for <b>{{$menu->title_en}}</b> </h5>
							</div>
							<div class="card-body">
								{!! Form::model($menuItem,['route' => 'cms.menu-items.store']) !!}

									@include('cms.menus.menu_items._form', ['submitButton' => "Save"])

								{!! Form::close() !!}
							</div>
						</div>
					</div>

					<div class="col-md-8">
						<div class="card">
							<div class="card-header"> <h5>Menu Items for <b>{{$menu->title_en}}</b> </h5></div>
							<div class="card-body">
								@if(empty($menu))
									<div class="col-md-12">
										<div class="alert alert-primary" role="alert">{{ label('lbl_no_information') }}	</div>
									</div>
								@else
									<div class="cf nestable-lists">

							        <div class="dd" id="nestable" ajax-url="/cms/ajax_menu_update">
							            <ol class="dd-list">
											{!! recursiveMenu('0',$menu->id) !!}
							            </ol>
							        </div>

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

@section('scripts')
	<script src="{!! asset('admin/js/jquery.nestable.js') !!}"></script>
	<script src="{!! asset('admin/js/movable_menu.js') !!}"></script>
	<script src="{!! asset('admin/js/menu.js') !!}"></script>
@stop
