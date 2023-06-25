@extends('cms.application')
@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-7">
									<div class="page-header-title">
											<h5 class="m-b-10">Feedback</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">Site Contents</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Informations</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Feedback</a></li>
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
							<div class="card-header" > <h5>Feedback</h5></div>
							<div class="card-body">
								@if($feedbacks->count() == 0)

									<div class="col-md-12">
										<div class="alert alert-primary" role="alert">{{ label('lbl_no_information') }}	</div>
									</div>
								@else

									<table class="table table-strip no-pg-dataTable dataTable" style="100%">
										<thead>
											<tr>
												<th>Name</th>
												<th>E-mail</th>
												<th>Phone</th>
												<th>Subject</th>
												<th>Message</th>
												<th>Created On</th>
												<th>Option</th>
											</tr>
										</thead>

										<tbody>

										@foreach($feedbacks as $key => $feedback)
											<tr class="shadow-on-hover">
												<td><strong>{{$feedback->name}}</td>
												<td><strong>{{$feedback->email}}</td>
												<td><strong>{{$feedback->phone}}</td>
												<td><strong>{{$feedback->subject}}</td>
												<td><strong>{{$feedback->message}}</td>
												<td><strong>{{ date_format(date_create($feedback->created_at), 'dS M Y, H:i:s') }}</strong></td>
												<td>
													{!! link_to_route('cms.feedback.destroy', "delete", array($feedback->id), array('data-method' => 'delete', 'data-confirm' => 'Are you Sure' ,'class' => 'label theme-b bg-danger text-white f-12')) !!}
												</td>
											</tr>
										@endforeach
										</tbody>
									</table>

									<div class="row justify-content-center">
										{{-- {!! $feedbacks->render() !!} --}}
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
