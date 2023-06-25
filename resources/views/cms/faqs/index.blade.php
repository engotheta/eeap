@extends('cms.application')
@section('content')

  <!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-12">
									<div class="page-header-title">
											<h5 class="m-b-10">Faqs</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">Information</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Faqs</a></li>
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

					<div class="col-sm-6">
						<div class="card">
							<div class="card-header" > <h5>Create New Faq</h5></div>
							<div class="card-body">

               				 {!! Form::open(['route' => 'cms.faqs.index']) !!}

        						@include('cms.faqs._form', ['submitButton' => "Save"])

        					{!! Form::close() !!}

							</div>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="accordion" id="accordionExample">
							@if($faqs->count() == 0)
								<div class="col-md-12">
									<div class="alert alert-primary" role="alert">{{ label('lbl_no_information') }}	</div>
								</div>
							@else
								@foreach($faqs as $key => $faq)
									<div class="card">
										<div class="card-header" id="{{ $faq->id }}">
											<h5 class="mb-0">
												<a class="" href="#!" data-toggle="collapse" data-target="#collapse{{ $faq->id }}" aria-expanded="true" aria-controls="collapseOne" class="">
													[ en ]{{ $faq->question_en }} <br>
													[ sw ]{{ $faq->question_sw }}
												</a>
											</h5>
										</div>
										<div id="collapse{{ $faq->id }}" class="card-body collapse @if ($key ==0) show	@endif" aria-labelledby="headingOne" data-parent="#accordionExample">
												[ en ] {!! nl2br($faq->answer_en) !!}<br><br>
                       							[ sw ] {!! nl2br($faq->answer_sw) !!}
											<a class="btn btn-primary float-right" href="{{ URL::route('cms.faqs.edit', $faq->id) }}" {{-- data-toggle="modal" data-target="#OpenModelContainer{{ $key }}" --}}>Edit</a>
                      						<a class="btn btn-danger float-right" href="{{ URL::route('cms.faqs.destroy', $faq->id) }}" data-method='delete', data-confirm='Are you Sure?'>Delete</a>
										</div>
									</div>

									{{-- <div class="modal fade" id="OpenModelContainer{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLongTitle"> Update <br> [ en ]{{ $faq->question_en }} <br> [ sw ]{{ $faq->question_sw }} </h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
												<div class="modal-body">
													{!! Form::model($faq, ['route' => ['cms.faqs.update', $faq->id], 'method' => 'PATCH']) !!}

														@include('cms.faqs._form', ['submitButton' => "Update"])

													{!! Form::close() !!}

												</div>
											</div>
										</div>
							    	</div> --}}
									
								@endforeach
								<div class="row justify-content-center">
									{!! $faqs->render() !!}
								</div>
							@endif
						</div>
					</div>

				</div>
			</div>
	</div>
	<!-- [ Main Content ] end -->


@stop
