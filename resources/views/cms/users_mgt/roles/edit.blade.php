@extends('cms.application')
@section('content')

<div class="content-panel">
    <div class="title">
        Edit Role
    </div>
</div>

<div class="row collapse">
	
	<div class="large-6 columns medium-12 small-12 columns">
		<div class="content-panel">
			<div class="title">
				Edit {{ $role->display_name }}
			</div>

			<div class="content">
				{!! Form::model($role, ['route' => ['cms.roles.update', $role->id], 'files' => true, 'method' => 'PATCH']) !!}

					@include('users_mgt.roles._form', ['submitButton' => "Update"])
				
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@stop