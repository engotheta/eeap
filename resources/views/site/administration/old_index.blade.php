@extends('site.layout')
@section('title')
  {{ $administration->title }}
@endsection

@section('css-content')
  <link rel="stylesheet" href="{{ asset('site/css/gridstack.min.css')}}">
  <style media="screen">
    .grid-stack-instance-6070 .grid-stack-item {
      min-height: 10px !important;
    }
    .grid-stack-item[data-gs-y="1"] {
        top: 40px !important;
    }
    .grid-stack-item[data-gs-y="2"] {
        top: 80px !important;
    }
    .grid-stack-item[data-gs-y="3"] {
        top: 120px !important;
    }
    .grid-stack-item[data-gs-y="4"] {
        top: 300px !important;
    }
    .grid-stack-item[data-gs-y="5"] {
        top: 310px !important;
    }
    .grid-stack-item[data-gs-y="6"] {
      top: 350px !important;
    }
    .grid-stack-item[data-gs-y="7"] {
      top: 400px !important;
    }
  </style>
  <script src="{{ asset('site/js/gridstack.min.js')}}"></script>
@stop

@section('content')

<div class="container-fluid px-0">
  <div class="col-12 px-0">
      
          {{-- @if ($page->banner_img && $page->banner)
              <div class="page-banner" style="background-image: url('{{asset('uploads/banners/'.$page->banner_img)}}')">
                  <div class="banner-gradient"> </div>
                  <div class="banner-shade"> </div>
                  <div class="banner-text d-flex px-3 px-lg-5 justify-content-between"> 
                      <div class="row col-12 px-0">
                          <h4 class=" col-lg-4 mb-2 "> 
                            <span class="banner-page-name d-inline-block font-weight-bold" > {{ $page->title }} </span> 
                          </h4>
                          <div class="banner-page-details col-lg-8 "> 
                              {{$page->banner}}
                          </div>
                      </div>
                  </div>
              </div>
          @endif --}}

          <div class="page-content">
              <div class="col-12 m-0">
                  
                      <div class="row">
          
                          <div class="col-md-9 col-12  bg-white pt-5 p-lg-5" style="min-height: 450px">
                              <h4 class="text-primary font-weight-bold">{{ $administration->title }}</h4>
                              <div class="heading-border"></div>
                              <div class="col-12 px-0 mb-3 pr-md-5">
                               <div class="my-4"> </div>
                                <div class="pb-4">
                                  <div class="grid-stack">

                                  </div>
                                </div>
                              </div>
                          </div>
          
                          <div class="col-md-3 col-12 p-md-3 navigation-column">
                            @include('site.includes.sidebar')
                          </div>
                        </div>
          
              </div>
          </div>
  </div>

</div>

@stop

@section('js-content')
  {{-- <script src="{{ asset('site/js/gridstack.min.js')}}"></script> --}}
  <script type="text/javascript">

  var grid = GridStack.init({
      float: true,
      removeTimeout: 100,
      acceptWidgets: '.grid-stack-item'
    });
     window.siteUrl = '{{url("")}}';
    // add content if exist from db
    @if ($administration->content != null)
    grid.removeAll();
      var items = GridStack.Utils.sort({!! $administration->content !!});
      grid.batchUpdate();
      items.forEach(function (node) {

        if (node['type'] == 'member') {
          @if(curlang() == '_sw')
            var fullname = node['salutation_sw'] +' '+ node['name'];
          @else
            var fullname = node['salutation_en'] +' '+ node['name'];
          @endif

          grid.addWidget('<div class="text-center"'+
                              'data-gs-member-salutation-sw="'+node['salutation_sw']+'"'+
                              'data-gs-member-salutation-en="'+node['salutation_en']+'"'+
                              'data-gs-name="'+node['name']+'"'+
                              'data-gs-image="'+node['image']+'">'+
                            '<div class="grid-stack-item-contentt justify-content-center m-3">'+
                                '<a href="'+window.siteUrl+'/administration/{{ $administration->slug}}/'+node['id']+'">'+
                                  '<div class="card">'+
                                    '<img class="img-fluid img-thumbnail w-100" src="'+window.siteUrl+'/uploads/administration/'+node['image']+'" alt="card image">'+
                                  '</div>'+
                                  '<div class="col-12 mt-2 px-0">'+
                                      '<h6 class="text-sm h-min-45 font-14">'+fullname+'</h6>'+
                                  '</div>'+
                                '</a>'+
                  // '<div class="col-12"><img src="'+window.siteUrl+'/uploads/administration/'+node['image']+'" class="w-100"/></div>'+
                  // '<div class="col-12"><h6 class="w-100 ">'+node['name']+'</h6></div>'+
                '<div/>'+
            '</div>', {x:node['x'], y:node['y'], width: node['width'], height:node['height']});
        } else {

          grid.addWidget('<div>'+
              '<div class="grid-stack-item-content text-center" ><b>'+node['name']+'</b></div></div>', {x:node['x'], y:node['y'], width: node['width'], height:node['height']});

        }
      });
      grid.commit();
    @endif

    grid.movable('.grid-stack-item', false);
    grid.resizable('.grid-stack-item', false);

    // console.log(data);

</script>
@stop
