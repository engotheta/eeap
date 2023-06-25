@extends('site.layout')
@section('title')
  {{ label('lbl_site_title') }} - {{ label('lbl_home') }}
@endsection

@section('content')

<div class="position-relative"> 

  <div class="bg-light position-relative d-noneeeee">
    <div class="home-slider px-4  position-relative ">
   
      @if(count($slideshow))
        <div class="slider-holder has-show-on-hover">
          <div id="homeCarousel" class="carousel slide carousel-fade h-100 bg-primary divideee position-relative" data-ride="carousel">
          
            <div class="bottom-left m-5  d-inline-block position-absolute" style="left:50px; bottom:50px; min-width: 200px">
              <div class="slider-nav-controls d-inline-flex position-relative">
                <div class="slider-nav-arrows " >
                  <span class="nav-control bg-white text-primary rounded-0 p-2 px-3 mr-1 hover-icon-left float-left"
                     href="#homeCarousel" role="button" data-slide="prev">
                    <span class="icon" aria-hidden="true"> <i class="fa fa-chevron-left "></i></span>
                    <span class="sr-only">Previous</span>
                  </span>
                  <span class="nav-control bg-white text-primary rounded-0 p-2  px-3  ml-1  hover-icon-right float-right" 
                    href="#homeCarousel" role="button" data-slide="next">
                    <span class="icon" aria-hidden="true"> <i class="fa fa-chevron-right "></i></span>
                    <span class="sr-only">Next</span>
                  </span>
                </div>
              </div>

              <ol class="pposition-relative carousel-indicators d-inline-flex  ml-0 "
               style="z-index: 999; transform:translateY(50px); left:0px !important " >
                <li data-target="#homeCarousel" data-slide-to="0" class="active"></li>
                @foreach($slideshow as $key => $photo) 
                  @break($key===count($slideshow)-1) 
                  <li data-target="#homeCarousel" data-slide-to="{{$key+1}}"></li>
                @endforeach
              </ol> 
            </div>

            <div class="carousel-inner ">
              @foreach($slideshow as $key => $photo)
                <div class="carousel-item @if ($key == 0) active  @endif" >    
                  <div class="full-hd-container parallax-banner " style="background-image:url('{{asset('uploads/gallery/'.$photo->filename)}}');
                    background-size:cover; background-repeat: no-repeat;" data-offset="100px" data-rate="0.35">
                    {{-- <img class="d-block w-100" src="{{asset('uploads/gallery/'.$photo->filename)}}" alt="First slide"> --}}
                  </div>  
                  @if (strlen(trim($photo->content)) > 2)                 
                    <div class=" d-none p-5  m-5 d-sm-inline-block position-absolute w-50" 
                      style="top:50%; transform:translateY(-50%); z-index:9999;" >
                      <div class="pr-3 text-white text-bold  position-relative" style="top:-60px; font-size: 50px">
                        {{ str_limit(strip_tags($photo->content),140) }} 
                      </div>
                      <a class="p-2 px-4 readmore bg-primary fade-on-hover cursor-pointer text-white position-relative" href=""> 
                        {{label('lbl_readmore')}}  <i class="pl-1 icon fa fa-chevron-right"></i>
                      </a>
                    </div>
                  @endif
                </div>
              @endforeach
            </div>
         
          </div>
        </div>
      @endif

      <!-- quick scroll -->
      <span class=" scroll-to-content text-white position-absolute cursor-pointer box-40 bg-white text-primary  " style="bottom:-20px"  >
        <i class="fa fa-chevron-down"></i> 
      </span>
      <!-- an anchor for scrolling to content -->
      <span class="position-absolute" style="height:0px; width:0px; bottom:5%" id="homeContentTether"></span>
  </div>
  

  <div class="home-content  bg-white ">
    @if(count($services))
      <div class="bg-white pt-4 py-5 parallax-banner position-relative" 
        style="background:urllll({{asset('site/images/bg/bg6.jpg')}}); background-size:cover; background-repeat: no-repeat;" 
        data-offset="250px" data-rate="0.2">
        <div class="container has-content-title ">
          <h5 class="text-black content-title py-5 max-width-680 mb-3">{{ label('lbl_our_services')}} </h5>

          <div class="row position-relative pt-2 mx-0">
              @foreach($services as $key => $service)
                <a href="{{url('/services/'.$service->slug)}}" class="col-sm-6 p-3 p-lg-4 col-md-4 col-lg-3 cursor-pointer" > 
                  <div class="border rounded-small h-100 bg-white hover-box-shadow p-3" style="min-height:200px">
                    <div class="mb-4 text-primary text-bold" style="font-size: 45px; line-height:40px" > 
                      {{str_pad($key+1, 2, '0', STR_PAD_LEFT) }} 
                    </div>
                    <div class="text-dark"> {!! str_limit(strip_tags($service->title) ,200) !!}</div>
                  </div>
                </a>
              @endforeach
          </div>
        </div>
      </div>
    @endif

    @if(count($news_list))
      <div class="bg-white pt-4 py-5 parallax-banner position-relative" 
        style="background:urllll({{asset('site/images/bg/bg6.jpg')}}); background-size:cover; background-repeat: no-repeat;" 
        data-offset="250px" data-rate="0.2">
        <div class="container has-content-title ">
          <h5 class="text-black content-title py-4 max-width-680 mb-3">{{ label('lbl_latest_news')}} </h5>

          <div class="row position-relative pt-2 mx-0">
            @foreach($news_list as $key => $news)
              <div  class="col-sm-6 p-3 p-lg-4 col-md-4 col-lg-3 cursor-pointer zoom-container has-dark-overlay" > 
                <div class="h-100 bg-white d-flex flex-column" style="min-height:200px">
                  <div class="mb-4 pt-2 text-capitalize text-bold border-top border-width-2 border-color-black" > 
                    {{$news->tag ?? 'Content Tag' }} 
                  </div>
                  <div class="overflow-hidden has-dark-overlay full-hd-container position-relative bg-secondary">
                    <img class="card-img-top image" src="{{asset('uploads/news/'.$news->photo_url)}}" alt="Card image cap">
                    <div class="dark-overlay"></div>
                  </div>
                  <div class="text-bold my-2">{{str_limit($news->title,40)}}</div>                
                  <div class="col px-0 text-dark"> {!! str_limit(strip_tags($news->content) ,200) !!}</div>
                  <a href="{{url('/news/'.$news->slug)}}" class="d-block mt-3 py-1 text-borld readmore bg-white  position-relative" > 
                    <div class="readmore text-bold  text-primary">
                      {{label('lbl_readmore')}}  <i class="pl-1 icon fa fa-chevron-right"></i>
                    </div>
                  </a>
                  <div class="faded small ">{!! date('d M Y', strtotime($news->created_at)) !!} </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    @endif


    
    @foreach($home_contents as $key => $home_content)
      <div class="bg-white pt-4 py-4 parallax-banner position-relative" 
        style="background:urllll({{asset('site/images/bg/bg6.jpg')}}); background-size:cover; background-repeat: no-repeat;" 
        data-offset="250px" data-rate="0.2">
        <div class="container has-content-title text-center">
          <h5 class="text-black content-title py-4 max-width-680 mb-4">{{  $home_content->title }} </h5>
          <div class="text-dark mx-auto mb-4 " style="max-width: 960px; "> {!! str_limit(strip_tags($news->content) ,600) !!}</div>
          <a class="d-inline-block p-2 px-4 readmore bg-primary fade-on-hover cursor-pointer text-white position-relative" href=""> 
            {{label('lbl_readmore')}}  <i class="pl-1 icon fa fa-chevron-right"></i>
          </a>
        </div>
      </div>
    @endforeach


    <div class="bg-white bg-secondary-fadeddd  position-relative py-4 pb-lg-5 ">
      <div class="h-100 bg-gradient-transparent-white top-left w-100 position-absolute" style="opacity:0.5"></div>
      <div class="container pb-5 py-3">
        <div class="mb-3 text-center pt-3 max-width-680">
          <h5 class="text-bold text-primary mb-3">{{label('lbl_stakeholders')}} </h5>
        </div>

        <div class="row">
          @foreach($stakeholderCategories as $key => $category) 
            @break($key > 2)
            <div class="col-md-4 px-lg-0 d-flex flex-column">
              <div class="mb-3 text-center pt-3 max-width-680">
                <h5 class="text-bold text-primary mb-3">{{$category->title}} </h5>
              </div>
              <div class="col px-0 d-flex flex-column">
                @foreach($category->stakeholders as $key => $stakeholder ) 
                  <div class="col mt-1 text-center has-hover-bounce has-shifting-underline  text-center position-relative" >
                    <a href="{{isset($stakeholder->url)? $stakeholder->url : url('/stakeholders/'.$category->slug.'/'.$stakeholder->slug)}}" @if(isset($stakeholder->url)) target="_blank" @endif 
                      class="h-100  cursor-pointer zoom-container show-more-content-news p-0 d-flex border-bottom box-shadow  
                      bg-white last-no-border align-items-center border-faded "  style="min-height:80px"> 
                      <div style="max-width:90px" class="col-3 col-md-4 p-2 h-100 bg-secondaryyy tex-left  d-flex flex-column justify-content-center pr-0 border-rightt " >
                        <div class="border-faded p-1">
                          <div class="overflow-hidden box-shadow-slight">
                            <div class=" mx-auto square-container bg-white image my-0 hover-text-primary background-image" 
                              style="background-image:url('{{asset('uploads/stakeholders/'.$stakeholder->photo_url)}}'); max-width:80px " >  
                              <div class="dark-overlay"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col  bg-secondary-faded h-100 pl-3 text-left hover-text-primary d-flex align-items-center "> 
                        {{$stakeholder->title}} 
                      </div>
                    </a>
                  </div>
                @endforeach
                <div class="col d-flex align-items-end text-center justify-content-center position-relative" style="height:60px" >
                  <a href="{{ url('/stakeholders/'.$category->slug)}}"  class="readmore bg-primary mt-4 border d-inline-block px-3 py-2 
                    rounded-medium  box-shadow-slight text-white hover-bg-secondary cursor-pointer  ">
                    <span>{{label('lbl_view_more')}} </span>
                    <i class="fa fa-chevron-right"></i>
                  </a> 
                </div>

              </div>
            </div>
          @endforeach

        </div>
      </div>
    </div>
    
 

  </div>
</div>

@stop





