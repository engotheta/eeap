<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>{{ label('lbl_site_title_short')}} | @yield('title') </title>
    <link rel="stylesheet" href="{{ asset('admin/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/auth.css') }}">
    {{-- pnotify --}}
    <link rel="stylesheet" href="{{ asset('admin/vendors/pnotify/pnotify.min.css')}}">


    <!-- favicons -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('admin/images/icon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('admin/images/icon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('admin/images/icon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin/images/icon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('admin/images/icon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('admin/images/icon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('admin/images/icon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('admin/images/icon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('admin/images/icon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('admin/images/icon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('admin/images/icon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{  asset('admin/images/icon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{  asset('admin/images/icon/favicon-16x16.png')}}">

  </head>

  <body >
    <div class="container login-container shadow">
      <div class="row">
        <div class="col-md-7 py-3 h-100 left-container t" style="background-image: url('{{asset('admin/images/pattern.jpg')}}')">
         <div class="ext-dark p-3 shadow d-inline-block" style="background:rgba(255,255,255,0.8)">
          <h1> <b>{{ label('lbl_site_title_short')}} </b> </h1>
          <h6> Content Management System </h6>
          </div> 
        </div>

        <div class="col-md-4 mx-auto">
            <div class="col-md-12">
              @empty ($logos->login_logo_url)
                <div class="profile-img"> <img loading="lazy" style="max-width:150px" src="{{ asset('admin/images/logo/logo.png') }}"> </div>
                @else
                  <div class="profile-img"> <img loading="lazy" style="max-width:150px" src="{{ asset('uploads/logos/'.$logos->login_logo_url) }}"> </div>
              @endempty
              <h3 class="text-center"><b>@yield('title')</b> </h3>

              @if (count($errors) > 0)
                <div class="alert alert-danger">
                  <ul class="px-1">
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif

              @if (session('status'))
                <div class="alert alert-success text-center" role="alert">
                  {{ session('status') }}
                </div>
              @endif

              @yield('main')
            </div>
        </div>
      </div>
    </div>

    <script src="{{ asset('admin/vendors/jquery/js/jquery.min.js') }}"></script>
    <script src="{{ asset('cms/vendors/bootstrap/js/bootstrap.min.js') }}" charset="utf-8"></script>
    {{-- pnotify --}}
    <script src="{{ asset('admin/vendors/pnotify/pnotify.min.js')}}"></script>

    @if (session('status') == 'success')
    <script type="text/javascript">
      new PNotify({
              title: 'Done',
              text: 'Completed Successfully.',
              type: 'success'
          });
    </script>
    @endif

    @if (session('status') == 'fail')
    <script type="text/javascript">
      new PNotify({
              title: 'Failed',
              text: 'Failed! Please try Again.',
              type: 'error'
          });
    </script>
    @endif
  </body>
</html>
