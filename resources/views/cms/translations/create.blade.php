@extends('cms.application')
@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-12">
									<div class="page-header-title">
											<h5 class="m-b-10">Translations</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">Settings</a></li>
											<li class="breadcrumb-item"><a href="{{ url('/cms/translations') }}">Translations</a></li>
											<li class="breadcrumb-item"><a href="javascript:">New Translation</a></li>
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
							<div class="card-header" > <h5>New Translation</h5></div>
							<div class="card-body">
								{!! Form::open(array('route' => 'cms.translations.store', 'enctype'=>'multipart/form-data')) !!}
								<div class="col-12">
										@if($errors->count())
											<div class="alert alert-warning col-12" role="alert">
												<span class='form_error'>{!! $errors->first('keyword') !!}</span> <br />
												<span class='form_error'>{!! $errors->first('en') !!}</span>
												<span class='form_error'>{!! $errors->first('sw') !!}</span>
											</div>
										@endif
								</div>

								<div class="col-md-12 px-0 mt-0">
									{{-- photo upload --}}
									<div class="card-body px-0 pt-0">
										<div class="row">
											<div class="col-md-4 form-group">
												{!! Form::label('keyword', 'keyword *') !!}
												{!! Form::text('keyword',null,['class'=>'form-control']) !!}
											</div>

											<div class="col-md-4 form-group">
												{!! Form::label('en', 'Content in  english *') !!}
												{!! Form::text('en',null,['class'=>'form-control']) !!}
											</div>


											<div class="col-md-4 form-group">
												{!! Form::label('sw', 'Content in  swahili *') !!}
												{!! Form::text('sw',null,['class'=>'form-control']) !!}
											</div>


											<div class="col-12 form-group">
												{!! Form::submit('Save', ['class' => 'btn btn-primary col-md-6 offset-md-3']) !!}
											</div>
										</div>
									</div>
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
