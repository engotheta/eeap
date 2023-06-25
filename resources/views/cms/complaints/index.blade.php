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
											<li class="breadcrumb-item"><a href="javascript:">{{ label('lbl_feedback') }}</a></li>
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
							<div class="card-header" > <h5>{{ label('lbl_feedback') }}</h5></div>
							<div class="card-body">
								@if($complaints->count() == 0)

									<div class="col-md-12">
										<div class="alert alert-primary" role="alert">{{ label('lbl_no_information') }}	</div>
									</div>
								@else

									<table class="table table-hover table-strip no-pg-dataTable dataTable" style="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Complaint Name</th>
												<th>Complaint E-mail</th>
												<th>Subject</th>
												<th>Created On</th>
												{{-- <th>Status</th> --}}
												<th>Option</th>
											</tr>
										</thead>

										<tbody>

										@foreach($complaints as $key => $complaint)
											<tr>
												<td>{{$key+1}}</td>
												<td>@php echo	wordwrap($complaint->first_name,20,"</br>")	@endphp </td>
												<td>@php echo	wordwrap($complaint->email,50,"</br>")	@endphp </td>
												<td>@php echo	wordwrap($complaint->subject,50,"</br>")	@endphp </td>
												<td><strong>{{ date_format(date_create($complaint->created_at), 'dS M Y, H:i:s') }}</strong></td>
												<?php // TODO: ajax change status to read ?>
												{{-- <td>@if ($complaint->read) Read @else Unread @endif<br/></td> --}}
													<td>
														<a href="{{ URL::route('cms.complaints.edit', $complaint->id) }}" data-toggle="modal" data-target="#OpenModelContainer{{ $key }}" class="label theme-bg2 text-white f-12">View & Reply</a>
														{!! link_to_route('cms.complaints.destroy', "Delete", array($complaint->id), array('data-method' => 'delete', 'data-confirm' => 'Are you Sure' ,'class' => 'label theme-b bg-danger text-white f-12')) !!}
													</td>

													<div class="modal fade" id="OpenModelContainer{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
											        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
											            <div class="modal-content">
											                <div class="modal-header">
											                    <h5 class="modal-title" id="exampleModalLongTitle"> Name: {{ $complaint->first_name }} </h5>
											                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											                        <span aria-hidden="true">×</span>
											                    </button>
											                </div>
											                <div class="modal-body">
																<h6> Reply To:
																	<a href="mailto:{{ $complaint->email }}"><i class="fas fa-reply"></i> {{ $complaint->email }} </a> 
																</h6>
																<h6>Fullname: {{ $complaint->first_name }}</h6>
																<h6>Phone: {{ $complaint->phone }}</h6>
																<h6>Organization: {{ $complaint->organization }}</h6>
																<h6>Subject: {{ $complaint->subject }}</h6>
																<h6><b>Message:</b> <br><hr class="my-2">{!! nl2br($complaint->message) !!}</h6>

											                </div>
											            </div>
											        </div>
											    </div>

											</tr>
										@endforeach
										</tbody>
									</table>

									<div class="row justify-content-center">
										{{-- {!! $complaints->render() !!} --}}
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
