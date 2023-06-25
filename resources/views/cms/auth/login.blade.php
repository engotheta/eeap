@extends('cms.auth.layout_auth')

@section('title') Login @stop
@section('main')

		<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="form-group col-12 w-icon has-error">
				<input name="email" id="username_id" class="form-control input-lg" placeholder="Email Address" required  type="email" value="{{ old('email') }}">
			</div>

			<div class="form-group col-12 w-icon has-error" >
				<input name="password" id="password_id" required class="form-control input-lg" placeholder="Password" type="password">
			</div>
			<div class="form-actions col-12">
				<input value="Login" class="btn bg-primary col-12 text-white" style="background:#306091 !important;" name="submit" type="submit">
			</div>
		</form>

      <div class="col-md-12 forget-password">
				<a href="{{ url('/password/email') }}" id="forgot-password-link">Forget Password?</a>
			</div>

      <div class="col-xl-12 text-center my-2 ">
        <small>
         <p class="mt-2">Copyright © <span id="copyrightDate">{{ date('Y') }}</span> . All Rights Reserved</p>
        </small>
      </div>

@endsection
