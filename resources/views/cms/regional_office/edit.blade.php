@extends('cms.application')
@section('content')

<div class="content-panel">
    <div class="title">
       Regional Offices
    </div>
</div>

<div class="row collapse">
	
	<div class="large-6 columns medium-12 small-12 columns">
		<div class="content-panel">
			<div class="title">
				Edit {{ $regional_office->deptName }}
			</div>

			<div class="content">
				{!! Form::model($regional_office, ['route' => ['cms.regional_office.update', $regional_office->id], 'method' => 'PATCH']) !!}

					@include('regional_office._form', ['submitButton' => "Update"])
				
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@stop