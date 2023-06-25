

<header class="d-md-flex align-items-center justify-content-between top-fixeddd box-shadow fixed-top bg-white"  style="z-index:999; min-height:130px">
  <div class="pl-md-5 p-3 h-100 d-flex align-items-center">
    <a href="{{ url('/') }}"><img src="{{asset('site/images/emblem.png')}}" alt="Logo" class="mx-3 mx-lg-4 img-fluid" style="width: 65px" /></a>
    <a href="{{ url('/') }}"><img src="{{asset('site/images/logo2.png')}}" alt="logo" class="mx-3 mx-lg-4 img-fluid fade-on" style="width:90px"/></a>
    <a href="{{ url('/') }}"><img src="{{asset('site/images/logo.png')}}" alt="logo" class="mx-3 mx-lg-4 img-fluid fade-on" style="height:70px"/></a>
  </div>

  <div class=" px-0 h-100 d-flex flex-column justify-content-between">
    <div class="col pr-md-5 p-3 py-lg-4 my-lg-2 d-flex align-items-center justify-content-end  text-uppercase ">
      <h3 class="mb-0  d-inline-block align-items-center text-bold text-primary "> {{ label("lbl_site_title")}}</h3>
    </div>

    <div class="col pr-md-5 bg-primary py-2 rounded-top-left-md-medium d-flex align-items-center justify-content-end">
      <!-- HEADER --> 
      <nav class="navbar h-100 main-navigation text-uppercase medium-text p-0 fade-on mx-lg-5 align-items-center" id='cssmenu' >
        <div id="head-mobile"></div>
        <div class="menu-button text-hover-secondary text-dark d-flex align-items-center d-lg-none">
          <i class="menu-icon fa fa-bars mr-2" style="font-size: 25px;"></i> 
          <span class=" bold-600">{{label('lbl_menu')}}</span>
        </div>
        <ul class="m-0 capitalize-parent-itemsss  d-lg-flex">
          <li class=""><a class="nav-link" href="{{ url('/') }}"> {{label('lbl_home')}} </a></li>
          {!! App\Models\MenuItem::getMenu('main_nav') !!}
          <li class="pr-2  @if(curlang() == '_en') d-none @endif"> <a title="language" href="{{ url('language/en') }}">
             <i class='fa fa-language pr-2'></i> ENGLISH</a> 
          </li>
          <li class="pr-3  @if(curlang() == '_sw') d-none @endif"> <a title="language" class="nav-link" href="{{ url('language/sw') }}">
            <i class='fa fa-language pr-2'></i>KISWAHILI</a> 
          </li>   
          <li class="search-toggle pr-1">  <a class="nav-link fas fa-search cursor-pointer"></a> </li>
        </ul>
      </nav>
      <!-- /HEADER -->

      <div class="search-form-container  rounded-top-left-md-medium move-left position-absolute top-left w-100 overflow-hidden"
        style="z-index: 9999999;">
        <div class="search-form  position-absolute top-left h-100 w-100  p-1  bg-primary box-shadow d-flex 
        align-items-center justify-content-center">
          <form  method="GET" action="{{url('search')}}" autocomplete="off"
            class=" d-flex justisty-content-between rounded-mediumm overflow-hiddenn py-0 mx-auto position-relative" action="">
            <div class="h-100 w-100 rounded-0 border bg-white position-absolute"></div>
            <div class="h-100 w-100  d-flex justisty-content-between  z-index-2">
              <input class="form-control border-0 bg-none text-primary " type="search" placeholder="Search" aria-label="Search" name="q"
                @if(isset($term)) value="{{$term}}"@endif/>
                <span class="d-flex">
                  <button type="submit" class="search-icon btn bg-white-transparentt" name="button">
                    <i class="fas fa-search fa-1x text-primary"></i>
                  </button>
                  <button type="button" class=" search-toggle border-left fadedd btn bg-white-transparentt" name="button">
                    <i class="fas fa-eye-slash fa-1x text-primary"></i>
                  </button>
                </span>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</header>
