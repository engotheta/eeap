<!DOCTYPE html>
<html lang="{{ str_replace('_', '', curlang()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Language" content="{{ str_replace('_', '', curlang()) }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @if (! empty($seo))
    <meta name="description" content="{{ $seo->content_en }} | {{ $seo->content_sw }}">
    <meta name="keywords" content="{{ $seo->keywords_en }} , {{ $seo->keywords_sw }} ">
  @endif
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
  <meta name="theme-color" content="#2e3289">
  <meta name="apple-mobile-web-app-status-bar-style" content="#2e3289">

  <title> {{ label('lbl_site_title_short')}} | @yield('title')  </title>

  <!-- favicons -->
  <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('site/images/icon/apple-icon-57x57.png')}}">
  <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('site/images/icon/apple-icon-60x60.png')}}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('site/images/icon/apple-icon-72x72.png')}}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('site/images/icon/apple-icon-76x76.png')}}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('site/images/icon/apple-icon-114x114.png')}}">
  <link rel="apple-touch-icon" sizes="120x120" href="{{asset('site/images/icon/apple-icon-120x120.png')}}">
  <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('site/images/icon/apple-icon-144x144.png')}}">
  <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('site/images/icon/apple-icon-152x152.png')}}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('site/images/icon/apple-icon-180x180.png')}}">
  <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('site/images/icon/android-icon-192x192.png')}}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{asset('site/images/icon/favicon-32x32.png')}}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{  asset('site/images/icon/favicon-96x96.png')}}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{  asset('site/images/icon/favicon-16x16.png')}}">

  <link rel="stylesheet" href="{{asset('site/css/master.min.css')}}">
  <link rel="stylesheet" href="{{asset('site/css/jquery-ui.css')}}">
  <link rel="stylesheet" href="{{asset('site/css/swiper.min.css')}}">
  <link rel="stylesheet" href="{{asset('site/css/select2.min.css')}}">

  <style type="text/css">
    /* for google iframe */
    .google-map iframe{
      height:100%;
      width:100%;
    }

    /* for google recaptcha */
    .g-recaptcha-bubble-arrow{
      display: none;
    }
    .g-recaptcha-bubble-arrow + div{
      position: fixed !important;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      -webkit-transform: translate(-50%, -50%);
    }

    /* control rending on rich text, for temporary use */
    .rich-text img{
      max-width: 100% !important;
      height: auto !important;
    }
    .rich-text table{
      max-width: 100% !important;
    }
    .padd-items-h-5 li a {padding-left:5px !important; padding-right:5px !important}

    .map-container-full iframe{
        width: 100% !important;
        height: 100% !important;
        min-height: 400px;
    }
  </style>

  @yield('css-content')
  @yield('header-js-content')

</head> 



<body>
  <div class="container max-1920 px-0">

    <!-- HEADER -->
    @include('site.includes/header')
    <!-- /HEADER -->

    <!-- contents -->
    <div class="site-content position-relative">
      @yield('content')
    </div>
    <!-- /contents -->

     <!-- CHATBOT -->
     {{-- @include('site.includes/chatbot') --}}
     <!-- /CHAtBOt -->

        <!-- SOCIALS -->
        @include('site.includes/social_media')
        <!-- /SOCIALS -->
   
    <!-- FOOTER -->
    @include('site.includes/footer')
    <!-- /FOOTER -->

  </div>
  <input type="hidden" id="base_url" value="{{ url('/') }}">

  <script src="{{ asset('site/js/jquery.min.js')}}"></script>
  <script src="{{ asset('site/js/jquery-ui.min.js')}}"></script>
  <script src="{{ asset('site/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('site/js/slick.min.js')}}"></script>
  <script src="{{ asset('site/js/owl.carousel.min.js')}}"></script>
  <script src="{{ asset('site/js/datatables.min.js')}}"></script>
  <script src="{{ asset('site/js/magnific-popup.min.js')}}"></script>
  <script src="{{ asset('site/js/select2.min.js')}}"></script>
  <script src="{{ asset('site/js/color-thief.min.js')}}"></script>
  <script src="{{ asset('site/js/swiper.min.js')}}"></script>
  <script src="{{ asset('site/js/particles.min.js')}}"></script>
  <script src="{{ asset('site/js/custom.min.js')}}"></script>
  <script src="{{ asset('site/js/select-search.min.js')}}"></script>
  <script src="{{ asset('site/js/particles-prop.min.js')}}"></script>
  <script src="{{ asset('site/js/dropdown.min.js')}}"></script>
  <script src="{{ asset('admin/js/visitors-counter/client.min.js')}}"></script>
  <script src="{{ asset('admin/js/visitors-counter/visitors.logs.js')}}"></script>

  <script type="text/javascript"> 
    const chatbot_container= document.querySelector('.chatbot-container');
    const chatbot_header = document.querySelector('.bot-header');

    if(chatbot_container){
      chatbot_header.addEventListener('click',()=>{
        chatbot_container.classList.toggle('active'); console.log(chatbot_container.classList)
      })
    }

    // get all iframes
    let iframes = document.querySelectorAll('iframe');
    console.log(iframes);
    
  </script>

  @yield('js-content')

</body>

</html>