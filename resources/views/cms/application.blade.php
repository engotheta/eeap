<!doctype html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ label('lbl_site_title_short')}}:: Dashboard</title>

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


    <link rel="stylesheet" href="{{ asset('admin/vendors/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/fonts/feather/css/feather.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/redactor/redactor.css') }}">
    {{-- animations --}}
    <link rel="stylesheet" href="{{ asset('admin/vendors/animation/css/animate.min.css')}}" >

    <link rel="stylesheet" href="{{ asset('admin/vendors/animation/css/lightbox.min.css')}}" >

    {{-- dataTables --}}
    <link rel="stylesheet" href="{{ asset('admin/vendors/DataTables/datatables.min.css') }}">

    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('admin/vendors/select2/dist/css/select2.min.css') }}">

    {{-- cropperjs --}}
    <link rel="stylesheet" href="{{ asset('admin/vendors/cropperjs/dist/cropper.min.css')}}">

    {{-- folder --}}
    <link rel="stylesheet" href="{{ asset('admin/css/folder/folders.css')}}">

    {{-- pnotify --}}
    <link rel="stylesheet" href="{{ asset('admin/vendors/pnotify/pnotify.min.css')}}">

    {{-- gridstack --}}
    <link rel="stylesheet" href="{{ asset('admin/vendors/gridstack/gridstack.min.css')}}">

    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

    <style rel="stylesheet">
        :root {
            --dark-color:#0880b3;
            --darker-color:#0880b3;
            --primary-color:#008dc9;
            /* --secondary-color:#ffb51f____; */
                --secondary-color:#3c4245;
            --primary-color-dark:#0880b3;
            --secondary-color-dark:#2c3235;
            --order:1.5; 
            }

        .bg-dark-light {
            background-color: var(--primary-color) !important; 
        }.ega-navbar a{
            /* color:var(--secondary-color); */
            color:bisque;
        }

        .ega-navbar a.nav-link:hover, .ega-navbar a.nav-link:active{
            /* color:var(--secondary-color); */
            /* color:var(--secondary-color-dark) !important; */
        }
        .ega-navbar .ega-submenu{
            background: var(--dark-color) !important;
        }
    </style>

    <script src="{{ asset('admin/vendors/jquery/js/jquery.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('admin/vendors/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">

    {{-- sweetalert --}}
    <link rel="stylesheet" href="{{ asset('admin/vendors/sweetalert/sweetalert.min.css') }}">
    <script src="{{ asset('admin/vendors/sweetalert/sweetalert.min.js') }}"></script>

    {{-- ck editor 4 --}}
    <script src="{{ asset('admin/vendors/ckeditor/ckeditor.js') }}"></script>

    @yield('stylesheets')

    @include('cms.includes.loader_css')


</head>
<body>
    <div class="position-fixed loader h-100 w-100 d-none" id="loader" style="z-index:9999; background:rgba(255, 255, 255, 0.7)">
        <div class="d-flex justify-content-center align-items-center h-100 w-100">
          <div class="loader-11 position-relative" style="top:0px !important"></div>
        </div>
     </div>

@if (Auth::guest())
    <center><h1>Please Login: <a href="{{ url('/system')}}">Here</a></h1>
        <br> <img loading="lazy" id="profile-img" class="profile-img-card" src="{{ asset('site/images/logo.png') }}"/>
    </center>
@else
    <!-- [ navigation menu ] start -->
    <nav class="ega-navbar bg-ega-dark">
        <div class="navbar-wrapper">
            <div class="navbar-brand header-logo bg-white">
                <a href="{{ url('/cms')}}" class="b-brand">
                    <div class="">
                        {{-- <i class="feather icon-trending-up"></i> --}}
                        @empty ($logos->login_logo_url)
                            <div class="profile-img"> <img loading="lazy" src="{{ asset('admin/images/logo/logo.png') }}" style="width:45px"> </div>
                        @else
                            {{-- <div class="profile-img"> <img loading="lazy" src="{{ asset('site/images/logo.jpg') }}" style="width:45px"> </div> --}}
                            <div class="profile-img"> <img loading="lazy" src="{{ asset('uploads/logos/'.$logos->login_logo_url) }}" style="width:45px"> </div>
                        @endempty
                    </div>
                    <span class="b-title text-white"> <b>{{ label('lbl_site_title_short')}}</b> </span>

                </a>
                <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
            </div>
            <div class="navbar-content bg-dark-light scroll-div" >
                @include('cms.includes.menu')
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->

    <!-- [ Header ] start -->
    @include('cms.includes.header')
    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    <div class="ega-main-container">
        <div class="ega-wrapper">
            <div class="ega-content">
                <div class="ega-inner-content position-relative">
                   

                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endif

{!! Session::pull('noty') !!}
{{-- gridstack --}}
<script src="{{ asset('admin/vendors/gridstack/gridstack.min.js')}}"></script>

<script src="{{ asset('admin/js/vendor-all.min.js') }}"></script>
<script src="{{ asset('admin/vendors/bootstrap/js/bootstrap.min.js') }}"></script>

{{-- redactorjs --}}
<script src="{{ asset('admin/vendors/redactor/redactor.js') }}"></script>
<script src="{{ asset('admin/vendors/redactor/plugins/fullscreen/fullscreen.js') }}"></script>
<script src="{{ asset('admin/vendors/redactor/plugins/imagemanager/imagemanager.js') }}"></script>
<script src="{{ asset('admin/vendors/redactor/plugins/filemanager/filemanager.js') }}"></script>
<script src="{{ asset('admin/vendors/redactor/plugins/video/video.js') }}"></script>

{{-- dataTable --}}
<script src="{{ asset('admin/vendors/DataTables/datatables.min.js')}}"></script>

{{-- animations --}}
<script src="{{ asset('admin/vendors/animation/lightbox.min.js')}}"></script>

{{-- select2 --}}
<script src="{{ asset('admin/vendors/select2/dist/js/select2.min.js')}}"></script>

{{-- input tag --}}
<script src="{{ asset('admin/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.js')}}"></script>

{{-- cropperjs --}}
<script src="{{ asset('admin/vendors/cropperjs/dist/cropper.min.js')}}"></script>
<script src="{{ asset('admin/vendors/cropperjs/dist/main.js')}}"></script>

{{-- pnotify --}}
<script src="{{ asset('admin/vendors/pnotify/pnotify.min.js')}}"></script>

<script src="{{ asset('admin/js/ega.min.js') }}"></script>

<script>
    window.csrfToken = '<?php echo csrf_token(); ?>';
    window.ajaxBasePath = "{{env('AJAX_BASEPATH','')}}";
    if(document.getElementById('upload_img')) document.getElementById('upload_img').setAttribute('value','');
</script>

<script type="text/javascript">
    // show loading when uploading
    var uploadEntityForm = document.getElementById("uploadEntityForm");
    var loadingForms = document.querySelectorAll(".loading-form");
    var loader = document.getElementById("loader");
    var entitiesLoader = document.getElementById("entitiesLoader");

    if(entitiesLoader) entitiesLoader.classList.add('d-none');

    if(uploadEntityForm && loader){
        uploadEntityForm.addEventListener("submit", ()=>{
            loader.classList.remove('d-none');
        });
    }

    if(loader){
        loadingForms.forEach(loadingForm => {
            loadingForm.addEventListener("submit", ()=>{
                loader.classList.remove('d-none');
            });
        });
    }

    if(document.getElementById('redactor_en') || document.getElementById('redactor_sw')){
        CKEDITOR.replace( 'redactor_sw',
        {
            // extraPlugins: 'uploadimage,image2',
            height: 300,
            filebrowserUploadUrl: "{{ url('/cms/upload?_token='. csrf_token())}}",
            filebrowserImageBrowseUrl: "{{ url('/cms/getimages?_token='. csrf_token())}}",
            filebrowserUploadMethod: 'form'
        });

        CKEDITOR.replace( 'redactor_en',
            {
                height: 300,
                filebrowserUploadUrl: "{{ url('/cms/upload?_token='. csrf_token())}}",
                filebrowserImageBrowseUrl: "{{ url('/cms/getimages?_token='. csrf_token())}}",
                filebrowserUploadMethod: 'form'
            });
    }

    for(i=0; i<100; i++){
        if(document.getElementById('redactor_en'+i) || document.getElementById('redactor_sw'+i)){
        CKEDITOR.replace( 'redactor_sw'+i,
        {
            // extraPlugins: 'uploadimage,image2',
            height: 300,
            filebrowserUploadUrl: "{{ url('/cms/upload?_token='. csrf_token())}}",
            filebrowserImageBrowseUrl: "{{ url('/cms/getimages?_token='. csrf_token())}}",
            filebrowserUploadMethod: 'form'
        });

        CKEDITOR.replace( 'redactor_en'+i,
            {
                height: 300,
                filebrowserUploadUrl: "{{ url('/cms/upload?_token='. csrf_token())}}",
                filebrowserImageBrowseUrl: "{{ url('/cms/getimages?_token='. csrf_token())}}",
                filebrowserUploadMethod: 'form'
            });
         }
    }
   
</script>
<script src="{{ asset('admin/js/custom.js') }}"></script>

@if (session('status') == 'success')
  <script type="text/javascript">
    new PNotify({
            title: 'DONE',
            text: 'Completed Successfully.',
            type: 'success'
        });
  </script>
@endif

@if (session('status') == 'fail')
  <script type="text/javascript">
    new PNotify({
            title: 'FAILED',
            text: 'Failed! Please try Again.',
            type: 'error'
        });
  </script>
@endif

@if($errors->count())
  <script type="text/javascript">
    new PNotify({
            title: 'ERRORS',
            text: 'Operation failed. Correct errors and try again',
            type: 'error'
        });
  </script>
@endif

@yield('scripts')

</body>
</html>
