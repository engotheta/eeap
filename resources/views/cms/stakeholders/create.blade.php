@extends('cms.application')
@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
		<div class="page-block">
			<div class="row align-items-center">
				<div class="col-md-12">
					<div class="page-header-title">
						<h5 class="m-b-10">Stakeholder</h5>
					</div>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
						<li class="breadcrumb-item"><a href="javascript:">Site Contents</a></li>
						<li class="breadcrumb-item"><a href="javascript:">Informations</a></li>
						<li class="breadcrumb-item"><a href="{{ url('/cms/stakeholder-categories/'.$category->slug) }}">{{$category->title}}</a></li>
						<li class="breadcrumb-item"><a href="javascript:">Create Stakeholder</a></li>
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
						<div class="card-header" > <h5>Create Quote</h5></div>
						<div class="card-body">
							{!! Form::open(['route' => 'cms.stakeholders.index', 'files' => true]) !!}
								<?php $aspectRatio = 1?>
								@include('cms.includes.cropimage',['img' => "" ])
								@include('cms.stakeholders._form', ['submitButton' => "Save"])
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

@stop
