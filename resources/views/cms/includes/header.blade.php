<header class="navbar ega-header navbar-expand-lg navbar-light">
		<a class="mobile-menu" id="mobile-header" href="javascript:">
				<i class="feather icon-more-horizontal"></i>
			{{-- @empty ($logos->login_logo_url) --}}
				<div class="profile-img"> <img loading="lazy" src="{{ asset('admin/images/logo/logo.png') }}"> </div>
				{{-- @else --}}
					{{-- <div class="profile-img"> <img loading="lazy" src="{{ asset('uploads/logos/'.$logos->login_logo_url) }}"> </div> --}}
			{{-- @endempty --}}
		</a>
		<div class="collapse navbar-collapse">

				<ul class="navbar-nav mr-auto">
						<li>
							<a href="javascript:" class="full-screen" onclick="javascript:toggleFullScreen()">
								<i class="feather icon-maximize"></i>
							</a>
						</li>

						<li class="nav-item">
								<div class="main-search">
										<div class="input-group">
												<input type="text" id="m-search" class="form-control" placeholder="Search . . .">
												<a href="javascript:" class="input-group-append search-close">
														<i class="feather icon-x input-group-text"></i>
												</a>
												<span class="input-group-append search-btn btn btn-primary">
														<i class="feather icon-search input-group-text"></i>
												</span>
										</div>
								</div>
						</li>
				</ul>

				<ul class="navbar-nav ml-auto">

						<li>
								<div class="dropdown drp-user">
										<a href="javascript:" class="dropdown-toggle" data-toggle="dropdown">
												<i class="icon feather icon-user"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-right profile-notification">
												<div class="pro-head">
														<img loading="lazy" src="{{ asset('admin/images/user_default.png') }}" class="img-radius" alt="User-Profile-Image">
														<span>{{Auth::user()->name}}</span>
												</div>
												<ul class="pro-body">
													{{-- <li><a href="#" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li> --}}
														{{-- <li>
															@if(curlang() == '_sw')
															 <a class="dropdown-item" href="{{ url('language/en') }}"><i class="feather icon-settings"></i>Switch Language to English</a>
															@else
															 <a class="dropdown-item" href="{{ url('language/sw') }}"><i class="feather icon-settings"></i>Switch Language to Kiswahili</a>
															@endif
														</li> --}}
														<li><a href="{{ route('cms.users.user-change-password-form') }}" class="dropdown-item"><i class="feather icon-edit-2"></i> Change Password</a></li>
														<li><a href="{{url('auth/logout')}}" class="dropdown-item"><i class="feather icon-log-out"></i> Log Out</a></li>
												</ul>
										</div>
								</div>
						</li>
				</ul>
		</div>
</header>
