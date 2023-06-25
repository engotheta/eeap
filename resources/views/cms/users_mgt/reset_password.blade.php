@extends('cms.application')
@section('content')

<div class="content-panel">
    <div class="title">
     	Change Password
    </div>
</div>

{!! Form::open(['route' => 'cms.users.user-change-password']) !!}
	<div class="large-5 columns">

		<div class="row collapse">
			<div class="large-12 columns">
				<span class='form_error'>{!! $errors->first('email') !!}</span>
				{!! Form::label('email', 'Enter Email') !!}
				{!! Form::password('email') !!}
			</div>
		</div>

		<div class="row">
			<div class="large-12 small-12 medium-12 columns">
				{!! Form::submit('Send Reset Link', ['class' => 'custom-button']) !!}
			</div>
		</div>
	</div>

{!! Form::close() !!}

@stop