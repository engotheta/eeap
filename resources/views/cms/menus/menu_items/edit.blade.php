
<!-- [ Edit Menu Content ] start -->
<div class="main-body">
		<div class="page-wrapper">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header" > <h5>Edit</h5></div>
						<div class="card-body pt-0 mt-0">
							{!! Form::model($menuitem, ['route' => ['cms.menu-items.update', $menuitem->id], 'method' => 'PATCH']) !!}

								@include('cms.menus.menu_items._form', ['submitButton' => "Update"])

							{!! Form::close() !!}
							<div class="col-12 px-0 py-0">
									<a href="{{route('cms.menu-items.destroy',$menuitem->id)}}" class="btn btn-danger col-12" data-method="DELETE">Delete</a>
							</div>
					</div>
				</div>

			</div>
		</div>
</div>
<!-- [ Edit menu Content ] end -->
