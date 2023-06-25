@extends('cms.application')
@section('content')

<div class="content-panel">
    <div class="title">
     	Edit
    </div>
</div>

<div class="row collapse">
	
	<div class="large-6 columns medium-12 small-12 columns">
		<div class="content-panel">
			<div class="title">
				 Edit  Role "{{$user->display_name}}"
			</div>

			<div class="content">
				{!! Form::model($user, ['route' => ['cms.roles.update', $user->id], 'method' => 'PATCH']) !!}

					@include('users_mgt._form', ['submitButton' => "Update"])
				
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@stop