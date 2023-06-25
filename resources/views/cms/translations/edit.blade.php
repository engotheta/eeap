@extends('system.application')
@section('content')

<div class="row">
	<div class="large-12 medium-12 small-12 columns">
		<div class="page-title">
			<a href="{{ URL::to('cms/publications')}}"><i class="back-icon"></i></a> Edit Publications
		</div>
	</div>
</div>

<div class="row">
	<div class="large-6 medium-12 small-12 columns">

		
			{{ Form::model($publication, array('route' => array('publications.update', $publication->id), 'method' => 'PATCH')) }}

<!-- 				<div class="large-12 columns">
					{{ Form::label('title_en', 'English title') }}
					{{ Form::text('title_en') }}
				</div>

				<div class="large-12 columns">
					{{ Form::label('title_sw', 'Swahili title') }}
					{{ Form::text('title_sw') }}
				</div> -->
					@include('publications._form')
			
			<div class="large-12 columns">
				{{ Form::submit('Save', array('class' => 'custom-button')) }}
			</div>

			{{ Form::close() }}
	</div>

	<div class="large-6 medium-12 small-12 columns">
		
	</div>
</div>

@stop