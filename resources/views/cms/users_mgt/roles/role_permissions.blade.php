@extends('cms.application')

@section('content')

<!-- [ breadcrumb ] start -->
<div class="page-header">
		<div class="page-block">
				<div class="row align-items-center">
						<div class="col-md-12">
								<div class="page-header-title">
										<h5 class="m-b-10">{{$role->name }} Permissions </h5>
								</div>
								<ul class="breadcrumb">
										<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
										<li class="breadcrumb-item"><a href="javascript:">User Administration</a></li>
										<li class="breadcrumb-item"><a href="{{ url('/cms/roles') }}">CMS Roles </a></li>
										<li class="breadcrumb-item"><a href="javascript:">{{$role->name }} Permissions </a></li>
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

				<div class="col-md-12">
					<div class="card">
						<div class="card-header" > <h5>List Of Permissions </h5></div>
						<div class="card-body">
							{!! Form::open(['route' => 'cms.users.update-user-permissions','class'=>'role-permission']) !!}
								{!!Form::hidden('role_id',$role->id)!!}

									<div class="perms row">
										@foreach($modules  as $name=>$actions)

											<div class="col-md-3">
												<h5 style="text-transform: capitalize;">{!! Form::checkbox('all',null,null,['class'=>'checkall']) !!} {{ str_replace('_',' ',substr(strrchr($name,'.'),1))}}</h5>
												<ul class="list-unstyled" >
													@foreach($actions as $action)
														<li class="list-item" style="padding-left:20px"><label>{!! Form::checkbox('permissions[]',$action->id,$action->permission_id) !!} {{ $action->action }}</label></li>
													@endforeach
												</ul>
											</div>

										@endforeach
									</div>

								<div class="row justify-content-center">
										{!! Form::submit("UPDATE", ['class' => 'btn btn-primary']) !!}
								</div>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
<!-- [ Main Content ] end -->

@stop

@section('scripts')

	<script type="text/javascript" charset="utf-8">
		$( document ).ready(function() {
		    $('.perms').on('click','.checkall',function(){
		    		$(this).parent().parent().find('ul li input').prop('checked',$(this).is(':checked'))
		    });
		});

	</script>

@stop
