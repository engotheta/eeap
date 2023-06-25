@extends('cms.application')
@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-7">
									<div class="page-header-title">
											<h5 class="m-b-10">Administration Members</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">User Administration</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Administration Members</a></li>
									</ul>
							</div>
							<div class="col-md-5 text-right">
									<a href="{{ url('/cms/administration/create')}}" class="btn btn-primary"> <i class="feather icon-edit"></i> Add Member</a>
							</div>
					</div>
			</div>
	</div>
	<!-- [ breadcrumb ] end -->

	<!-- [ Main Content ] start -->
	<div class="main-body">
			<div class="page-wrapper">
				<div class="row">
					<div class="col-sm-12">
              <input type="text" id="member-search" class="form-control mb-4" placeholder="search Member . . ">
          </div>

					@if($administration->count() == 0)
						<div class="col-md-12">
							<div class="alert alert-primary" role="alert">{{ label('lbl_no_information') }}	</div>
						</div>
					@else
						<div class="row px-3 members">
							@foreach($administration as $key => $admin)
								<div class="col-md-4 member-block" data-filter="{{ $admin->title }} {{ $admin->salution }} {{ $admin->fullname }} {{ $admin->phone }} ">
									<div class="card absolute mx-3" style="min-width:170px">
										<img loading="lazy" src="{{ asset('/uploads/administration/'.$admin->photo_url) }}" class="w-100" style="min-width:170px" alt="">
										<div class="card-body px-1">
											<h6> <b>{{ $admin->salution }} {{ $admin->fullname }}</b> </h6>
											<h6> <i>{{ $admin->title }}</i> </h6>
											<div class="col-12 px-0 text-right">
													<a href="{{ URL::route('cms.administration.edit', $admin->id) }}" class="label theme-bg2 text-white f-12">View & Edit</a>
													{!! link_to_route('cms.administration.destroy', "Delete", array($admin->id), array('data-method' => 'delete', 'data-confirm' => 'Are you Sure' ,'class' => 'label theme-b bg-danger text-white f-12')) !!}
											</div>
										</div>
									</div>
								</div>

							@endforeach
						</div>

						<div class="col-12 row justify-content-center">
							{{-- {!! $administration->render() !!} --}}
						</div>
					@endif
				</div>
			</div>
	</div>
	<!-- [ Main Content ] end -->

@stop
@section('scripts')
	<script type="text/javascript">
						$("#member-search").on("keyup", function() {
								var g = $(this).val().toLowerCase();
								$(".members .member-block").each(function() {
										var content = $(this).attr('data-filter');
										if (content) {
												var search = content.toLowerCase();
										}
										if (search) {
												var n = search.indexOf(g);
												if (n !== -1) {
														$(this).show();
												} else {
														$(this).hide();
												}
										}
								});
						});
	</script>
@stop
