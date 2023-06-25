
@extends('cms.auth.layout_auth')

@section('title') Forgot Password @stop

@section('main')

       <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">

         <div class="form-group">
         <div class="col-md-2"></div>
           <div class="col-md-12 form-group">
             <input type="email" required placeholder="Enter your email address" class="form-control" name="email" value="{{ old('email') }}">
           </div>
         </div>

         <div class="form-group">
           <div class="col-md-12">
             <input type="submit" style="background:#306091 !important;"  class="btn btn-primary text-white col-12" value="Send Password Reset Link">
           </div>
         </div>
       </form>

        <div class="col-md-12 forget-password"><a href="{{ url('/system') }}" id="forgot-password-link">Already Send the Link? Log in</a></div>

        <div class="col-xl-12 text-center my-2 ">
          <small> <p class="mt-2">© <span id="copyrightDate">{{ date('Y') }}</span> . All Rights Reserved</p> </small>
        </div>
@endsection
