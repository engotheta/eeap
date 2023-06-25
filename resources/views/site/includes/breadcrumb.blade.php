<div class="container-fluid px-lg-5 breadcumb-banner  bold-600 parallax-banner faded-banner"  
    @if($background) style="background-image:url({{asset($background->main_bg)}});   background-repeat: no-repeat; background-size: cover;" @endif
    data-offset="270px" data-rate="0.3">
        <div class="banner px-lg-5 pt-5">    
            <div class="banner-inner position-relative" style="z-index: 1;">
                <ol class="breadcrumb fa bg-transparent px-3 px-lg-0 text-dark">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><span class="fas fa-home"></span></a></li>
                    @yield('breadcrumb')
                </ol>
            </div>
        </div>
</div>