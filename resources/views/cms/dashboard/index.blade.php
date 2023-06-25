@extends('cms.application')
@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
		<div class="page-block">
			<div class="row align-items-center">
				<div class="col-md-12">
					<div class="page-header-title">
						<h5 class="m-b-10">DASHBOARD</h5>
					</div>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
						<li class="breadcrumb-item"><a href="javascript:">Dashboard</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- [ breadcrumb ] end -->

	<!-- [ Main Content ] start -->
	<div class="main-body">
		<div class="page-wrapper">
			{{-- Visitor counter --}}
			<div class="row">
				<div class="col-xl-4 col-md-6">
					<div class="card user-list">
						<div class="card-header">
							<h5>Visitors Counter</h5>
						</div>
						<div class="card-block">
							<div class="row">
								<div class="col-xl-12">
									<h6 class="align-items-center float-left"><i class="fas fa-star f-10 m-r-10 text-c-yellow"></i>Today</h6>
									<h6 class="align-items-center float-right">{{ number_format($today) }}</h6>
									<div class="progress m-t-30 m-b-20" style="height: 6px;">
										<div class="progress-bar progress-c-theme" role="progressbar" style="width: {{ ($today/$visitors)*100 }}%;" aria-valuemax="100"></div>
									</div>
								</div>

								<div class="col-xl-12">
									<h6 class="align-items-center float-left"><i class="fas fa-star f-10 m-r-10 text-c-yellow"></i>Yesterday</h6>
									<h6 class="align-items-center float-right">{{ number_format($yesterday) }}</h6>
									<div class="progress m-t-30  m-b-20" style="height: 6px;">
										<div class="progress-bar progress-c-theme" role="progressbar" style="width: {{ ($yesterday/$visitors)*100 }}%;" aria-valuemax="100"></div>
									</div>
								</div>

								<div class="col-xl-12">
									<h6 class="align-items-center float-left"><i class="fas fa-star f-10 m-r-10 text-c-yellow"></i>This week</h6>
									<h6 class="align-items-center float-right">{{ number_format($this_week) }}</h6>
									<div class="progress m-t-30  m-b-20" style="height: 6px;">
										<div class="progress-bar progress-c-theme" role="progressbar" style="width: {{ ($this_week/$visitors)*100 }}%;" aria-valuemax="100"></div>
									</div>
								</div>

								<div class="col-xl-12">
									<h6 class="align-items-center float-left"><i class="fas fa-star f-10 m-r-10 text-c-yellow"></i>This Month</h6>
									<h6 class="align-items-center float-right">{{ number_format($this_month) }}</h6>
									<div class="progress m-t-30  m-b-20" style="height: 6px;">
										<div class="progress-bar progress-c-theme" role="progressbar" style="width: {{ ($this_month/$visitors)*100 }}%;" aria-valuemax="100"></div>
									</div>
								</div>

								<div class="col-xl-12">
									<h6 class="align-items-center float-left"><i class="fas fa-star f-10 m-r-10 text-c-yellow"></i>This Year</h6>
									<h6 class="align-items-center float-right">{{ number_format($this_year) }}</h6>
									<div class="progress m-t-30  m-b-20" style="height: 6px;">
										<div class="progress-bar" role="progressbar" style="width:{{ ($this_year/$visitors)*100 }}%;" aria-valuemax="100"></div>
									</div>
								</div>

								<div class="col-xl-12">
									<h6 class="align-items-center float-left"><i class="fas fa-star f-10 m-r-10 text-c-yellow"></i> All Visitors</h6>
									<h6 class="align-items-center float-right">{{ number_format($visitors) }}</h6>
									<div class="progress m-t-30  m-b-20" style="height: 6px;">
										<div class="progress-bar" role="progressbar" style="width:100%;" aria-valuemax="100"></div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-8 col-md-6">
					<div class="card user-list">
						<div class="card-header">
							<h5>Browsers Per Visitors</h5>
						</div>
						<div class="card-block">
							<div class="row">
								<div id="morris-bar-chart" width="100%" height="335px"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			{{-- /Visitor counter --}}
		</div>
	</div>
	<!-- [ Main Content ] end -->

@stop

@section('scripts')
	<script src="{{ asset('admin/vendors/chart-morris/js/raphael.min.js')}}" charset="utf-8"></script>
	<script src="{{ asset('admin/vendors/chart-morris/js/morris.min.js')}}" charset="utf-8"></script>

	<script>
// 		Morris.Bar({
// 			element: 'morris-bar-chart',
// 			data: {!! json_encode($visitors_per_browser) !!} ,
// 			xkey: 'browserName',
// 			barSizeRatio: 0.5,
// 			// barGap: 3,
// 			resize: true,
// 			responsive:true,
// 			ykeys: ['total',],
// 			labels: ['Visitors Used', 'Browsers',],
// 			barColors: ["0-#1de9b6-#1dc4e9", "0-#899FD4-#A389D4", "#04a9f5"]
// 		});
	</script>
@stop
