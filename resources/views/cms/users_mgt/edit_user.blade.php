@extends('cms.application')
@section('content')

<div class="row collapse">

	<div class="large-6 columns medium-12 small-12 columns">
		<div class="content-panel">
			<div class="title">
				Edit User
			</div>

			<div class="content content-large">
					{!! Form::model($users, ['route' => ['cms.users.update-user', $users->id], 'files' => true, 'method' => 'POST']) !!}
					{!! Form::label('Reset Password', ' Reset Password') !!}
				    {!! Form::checkbox('check') !!}
					@include('users_mgt._form', ['submitButton' => "Save"])
				
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>


@stop
