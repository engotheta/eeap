@extends('cms.application')
@section('content')

<div class="content-panel">
    <div class="title">
       Edit {{ $gallery->title_en }}
    </div>
</div>

<div class="row collapse">
	
	<div class="large-6 columns medium-12 small-12 columns">
		<div class="content-panel">
			<div class="title">
				{{ $gallery->title_en }}
			</div>

			<div class="content">
				{!! Form::model($gallery, ['route' => ['cms.galleries.update', $gallery->id], 'method' => 'PATCH']) !!}

					@include('galleries._form', ['submitButton' => "Update"])
				
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@stop