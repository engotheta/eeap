@extends('cms.application')
@section('content')

<div class="content-panel">
    <div class="title">
        Publications
    </div>
</div>

<div class="row collapse">
	
	<div class="large-6 columns medium-12 small-12 columns">
		<div class="content-panel">
			<div class="title">
				Edit {{ $publication->title_en }}
			</div>

			<div class="content">
				{!! Form::model($publication, ['route' => ['cms.publications.update', $publication->id], 'files' => true, 'method' => 'PATCH']) !!}

					@include('publications._form', ['submitButton' => "Update"])
				
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@stop