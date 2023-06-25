@extends('cms.application')
@section('content')

<div class="content-panel">
    <div class="title">
        // faqs
    </div>
</div>

<div class="row collapse">
	
	<div class="large-6 columns medium-12 small-12 columns">
		<div class="content-panel">
			<div class="title">
				Edit {{ $menu->name }}
			</div>

			<div class="content">
				{!! Form::model($menu, ['route' => ['cms.menu.update', $menu->id], 'method' => 'PATCH']) !!}

					@include('menus._form', ['submitButton' => "Update"])
				
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@stop