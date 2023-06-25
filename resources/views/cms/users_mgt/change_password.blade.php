@extends('cms.application')
@section('content')


  	<!-- [ breadcrumb ] start -->
  	<div class="page-header">
  			<div class="page-block">
  					<div class="row align-items-center">
  							<div class="col-md-12">
  									<div class="page-header-title">
  											<h5 class="m-b-10">Profile</h5>
  									</div>
  									<ul class="breadcrumb">
  											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
  											<li class="breadcrumb-item"><a href="javascript:">Change Password</a></li>
  									</ul>
  							</div>
  					</div>
  			</div>
  	</div>
  	<!-- [ breadcrumb ] end -->

  	<!-- [ Main Content ] start -->
  	<div class="main-body">
  			<div class="page-wrapper">
  				<div class="row">
  					<div class="col-md-12">
  						<div class="card">
  							<div class="card-header" > <h5>Change Password</h5></div>
  							<div class="card-body">

                  <div class="col-md-8 col-12 px-0">
                    @if(Session::has('message'))	
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong> {{Session::get('message')}} </strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
					  </div>
					@endif
                  </div>

                  {!! Form::open(['route' => 'cms.users.user-change-password']) !!}

                    <div class="row">
                      <div class="col-12 col-md-8 form-group">
                        {!! Form::label('current_password', 'Current Password *') !!}
                        {!! Form::password('current_password',['class'=>'form-control','required'=>'required']) !!}
                        <span class='col-12 text-danger form-error'>{!! $errors->first('current_password') !!}</span>

                      </div>
                      <div class="col-12 col-md-8 form-group">
                        {!! Form::label('password', 'New Password *') !!}
                        {!! Form::password('password',['class'=>'form-control','required'=>'required']) !!}
                        <span class='col-12  text-danger form-error'>{!! $errors->first('password') !!}</span>
                      </div>
                      <div class="col-12 col-md-8 form-group">
                        {!! Form::label('password_confirmation', 'Retype Password *') !!}
                        {!! Form::password('password_confirmation',['class'=>'form-control','required'=>'required']) !!}
                        <span class='col-12 text-danger'>{!! $errors->first('password_confirmation') !!}</span>

                      </div>
                      <div class="col-12 form-group">
                        {!! Form::submit('Change Password', ['class' => 'btn btn-primary']) !!}
                      </div>
                    </div>

  								{!! Form::close() !!}
  							</div>
  						</div>
  					</div>

  				</div>
  			</div>
  	</div>
  	<!-- [ Main Content ] end -->
@stop
