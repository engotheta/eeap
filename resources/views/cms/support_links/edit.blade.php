@extends('cms.application')
@section('content')

<div class="content-panel">
    <div class="title">
        {{-- Support Links --}}
				Consumer Services Links
    </div>
</div>

<div class="row collapse">
	
	<div class="large-6 columns medium-12 small-12 columns">
		<div class="content-panel">
			<div class="title">
				Edit {{ $link->title_en }}
			</div>

			<div class="content">
				{!! Form::model($link, ['route' => ['cms.support_links.update', $link->id], 'method' => 'PATCH']) !!}

					@include('support_links._form', ['submitButton' => "Update"])
				
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@stop