@extends('cms.auth.layout_auth')

@section('title') Reset Password @stop

@section('main')

				<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="token" value="{{ $token }}">

					<div class="form-group w-icon has-error">
						<input name="email" placeholder="Enter Email Address" class="form-control" value="{{ old('email') }}" required type="email">
					</div>

					<div class="form-group w-icon has-error" >
						<input name="password" placeholder="Enter your new Password" required class="form-control" placeholder="Password" type="password">
					</div>

					<div class="form-group w-icon has-error" >
						<input name="password_confirmation"  placeholder="Re-enter your new Password" required class="form-control"  type="password">
					</div>

					<div class="form-actions">
						<input value="Reset" class="btn bg-primary col-12 text-white" style="background:#306091 !important;" name="submit" type="submit">
					</div>
				</form>

          <div class="col-xl-12 text-center my-2 ">
            <small>
             <p class="mt-2">Copyright © <span id="copyrightDate">{{ date('Y') }}</span> .{{ label('lbl_copyright')}}</p>
            </small>
          </div>

@stop
