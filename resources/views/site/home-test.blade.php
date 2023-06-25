
@extends('site.layout')
@section('title')
  {{ label('lbl_site_title') }} - {{ label('lbl_home') }}
@endsection

@section('content')

<div class="home-page-bodyyyy position-relative"> 

  <div class="bg-light position-relative d-noneeeee">
    <div class="w-100 top-left position-absolute bg-gradient-primary-transparentt" style="background:#000; opacity: 0.1; height:50%; transform: scaleY(1);"></div>
    <div class="h-100 w-100 top-left position-absolute bg-gradient-primary-transparentt" style="background:#000; opacity: 0.08; transform: scaleY(-1);"></div>
    <div class="home-slider  position-relative ">
   
      @if(count($slideshow))
        <div class="slider-holder slider-bg has-show-on-hover">
          <div id="homeCarousel" class="carousel slide carousel-fade h-100 bg-primary divideee position-relative" data-ride="carousel">
            <ol class="carousel-indicators" style="z-index: 999; transform:translateY(10px)" >
              <li data-target="#homeCarousel" data-slide-to="0" class="active"></li>
              @foreach($slideshow as $key => $photo) @break($key===count($slideshow)-1) <li data-target="#homeCarousel" data-slide-to="{{$key+1}}"></li>@endforeach
            </ol> 
            {{-- <div class="slider-nav-controls show-on-hover w-100 px-3  position-absolute">
              <div class="slider-nav-arrows " >
                <span class="nav-control border-0 p-33 hover-icon-left hover-bgg   float-left" href="#homeCarousel" role="button" data-slide="prev">
                  <!-- <span class="icon" aria-hidden="true"> <i class="fa fa-chevron-left "></i></span> -->
                  <div class="icon box-30"> 
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 91.6">
                      <polygon class="stroke-white"  points="52.51 45.8 77.5 2.5 2.5 45.8 77.5 89.1 52.51 45.8"/>
                    </svg>
                  </div>
                  <span class="sr-only">Previous</span>
                </span>
                <span class="nav-control border-0 hover-icon-right hover-bgg p-33  float-right" href="#homeCarousel" role="button" data-slide="next">
                  <!-- <span class="icon" aria-hidden="true"> <i class="fa fa-chevron-right "></i></span> -->
                  <div class="icon box-30"> 
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 91.6">
                      <polygon class="nav-arrows stroke-white" points="27.49 45.8 2.5 2.5 77.5 45.8 2.5 89.1 27.49 45.8"/>
                    </svg>
                    </div>
                  <span class="sr-only">Next</span>
                </span>
              </div>
            </div> --}}
            <div class="carousel-inner ">
              @foreach($slideshow as $key => $photo)
              <div class="carousel-item @if ($key == 0) active  @endif" >    
                <div class="full-hd-container background-image" 
                style="background-image:url('{{asset('uploads/gallery/'.$photo->filename)}}'); background-attachment:fixedddd; background-position:top !important">
                  {{-- <img class="d-block w-100" src="{{asset('uploads/gallery/'.$photo->filename)}}" alt="First slide"> --}}
                </div>                  
                <div class="cursor-pointer top-left h-100 w-100 p-2 px-lg-4 carousel-text  d-flex align-items-center ">
                  <!--<div class="bg-primary h-100 w-100 position-absolute top-left" style="opacity: 0.1"> </div>-->
                  <!--<div class="bg-primaryy h-100 w-100 position-absolute top-left" style="background:#000; opacity: 0.1"> </div>-->
                  <h2 style="transform: translate(-200px,30px)"
                  class="d-none d-sm-block w-100 max-width-480 text-white text-bold text-left position-relative"> 
                    {{ str_limit(strip_tags($photo->content),60) }}
                  </h2>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      @endif

      @if(isset($regional_office->phone))
      <div class="d-flex position-absolute bottom-left m-3 m-lg-4 align-items-center rounded-medium bg-primary
      text-white has-hover-text-secondary box-shadow-slight p-2 px-3 cursor-pointer"
       style="z-index: 999">
        <span class="mr-3 box-35 position-relative flex-center ">
          <i class="fa fa-phone hover-text-secondary"></i>
          <span class="position-absolute box-35 round border border-color-white expanding-item"></span>
        </span>
        <div class="">
          <div class="faded">{{label('lbl_call_us')}} </div>
          <div class="hover-text-secondary">{{$regional_office->phone}}</div>
        </div>
      </div>
      @endif


      @if($latest_news->count())
        <div class="d-lg-flex d-none position-absolute top-right m-5 max-width-320 align-items-center rounded-slight bg-transparent-white
        text-white has-hover-text-secondary box-shadow-slight cursor-pointer rounded-top-right-0"
        style="z-index: 999; transform:translate(-3px,20px)">
            <div class="position-relative pt-2">
                <h5 style="transform:translate(-10px,-10px)"
                class="position-absolute top-left text-bold section-heading bg-secondary text-dark rounded-top-left-20 rounded-bottom-right-20"> 
                  <a href="{{url('news/')}}" class="d-inline-block p-2 px-3 rounded-top-left-20 rounded-bottom-right-20 hover-bg position-relative">
                    <div class="pr-sm-2 text-primary d-inline-block position-relative"> 
                      <span class="border-left-secondary-thickk">{{label('lbl_latest_news')}}</span> 
                      <span class="position-absolute view-all">
                        <i class="fa fa-arrow-right"> </i> 
                        <span class="text-small text-nowrap d-inline-block pl-2 ">{{label('lbl_view_all')}} </span> 
                      </span>
                    </div>
                  </a>                
                </h5>

                <div class="pt-4">
                   @foreach($latest_news as $key => $news)
                      <a href="{{url('news/'.$news->slug)}}" 
                        class="d-block hover-bg p-1 px-3 small-line-height text-hover-primary border-bottom-faded-dotted last-no-border">
                        <div class="">{{ str_limit(strip_tags($news->title),60)}}  </div> 
                        <div class="small faded mt-1">{{ date('jS M, Y', strtotime($news->created_at)) }} </div>
                      </a>
                   @endforeach
                </div>
		<div class="text-right p-2">
 		    <a href="{{url('/news')}}" class="readmore border d-inline-block px-3 py-2 rounded-medium  box-shadow-slight text-primary hover-bg-primary cursor-pointer  ">
        		<span> {{label('lbl_view_all')}}</span>
      			<i class="fa fa-chevron-right"></i>
     		    </a>   
		</div>
            </div>
        </div>
      @endif

      <!-- quick scroll -->
      <span class=" scroll-to-content text-white position-absolute cursor-pointer box-40 "  >
        <!-- <i class="fa fa-chevron-down"></i> -->
        <svg xmlns="http://www.w3.org/2000/svg" class="mt-5" viewBox="0 0 90.55 50.67"><polygon class="stroke-white " points="45.27 17.54 1.97 1.97 45.27 48.69 88.58 1.97 45.27 17.54"/></g></g></svg>
      </span>
      <!-- an anchor for scrolling to content -->
      <span class="position-absolute" style="height:0px; width:0px; bottom:5%" id="homeContentTether"></span>
  </div>
  
  
  <div class="owl-carousel-3 overflow-hidden bg-white has-show-on-hover border-bottom border-color-black owl-theme owl-loaded parallax-banner position-relative">
   {{-- <div class="bg-white h-100 w-100 position-absolute top-left faded"></div> --}}
   <div class="owl-stage-outer " >
     <div class="owl-stage " style="display:flex">
       @foreach($licensed_entity_categories as $key => $category)
          <?php 
            if(strpos(strtolower($category->title_en), 'agent') !== false) {$icon = asset('site/images/svgs/agent.svg');}
            elseif(strpos(strtolower($category->title_en), 'compan') !== false) {$icon = asset('site/images/svgs/business.svg');}
            elseif(strpos(strtolower($category->title_en), 'asseso') !== false) {$icon = asset('site/images/svgs/business-deal.svg');}
            elseif(strpos(strtolower($category->title_en), 'reinsurance brokers') !== false) {$icon = asset('site/images/svgs/crown.svg');}
            elseif(strpos(strtolower($category->title_en), 'licensing brokers') !== false) {$icon = asset('site/images/svgs/license.svg');}
            elseif(strpos(strtolower($category->title_en), 'accredite') !== false) {$icon = asset('site/images/svgs/airplane.svg');}
            else {$icon = asset('site/images/svgs/insurance.svg');}
          ?>
         <div class="owl-item text-center has-hover-bounce last-no-border-element text-center position-relative" >
           <a href="{{ url('/licensed-entities/'.$category->slug)}}" class=" hover-bg border-right border-color-dark
              box-shadow-slightt d-block p-2">
             <div class="py-2  d-flex h-100 justify-content-center position-relative align-items-center ">
               <div class="border-primaryyy border-width-3 round d-flex 
                   position-absolute justify-content-center align-items-center m-auto box-50">
               </div>
               <div class="ring d-flex position-absolute justify-content-center align-items-center m-auto box-50">
                 <div class="h-100 round w-100 position-relative d-inline-block" 
                 style="background-image:urlll('{{$category->image}}'); background-size:cover; background-position: center;">
                 </div> 
               </div>
               <div class="round bg-primaryyyy d-flex position-absolute
                justify-content-center align-items-center m-auto box-50"></div>
               <img src="{{ asset($icon) }}" class="hover-bounce dark-icon" style="width: 30px; height:auto">
             </div> 
             <div class="text-bold text-dark small">
               <span class="bg-white-transparentt d-inline-block p-1 rounded-slight">
                 <span class="px-1"> {{$category->title}} </span> |  <span class="px-1 faded"> {{$category->licensedEntities->count()}} </span> 
               </span>
             </div>
           </a>
         </div>
       @endforeach
     </div>
     {{-- <div class="owl-controls  pt-4"></div> --}}
     <!-- get button here -->
     <!-- <div class="d-none " >
       <span class="hover-icon-left show-on-hover owl-prev-template-3">
         <div class="icon box-30"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 91.6"><polygon class="fill-primary"  points="52.51 45.8 77.5 2.5 2.5 45.8 77.5 89.1 52.51 45.8"/></svg></div>
       </span>
       <span class="hover-icon-right show-on-hover owl-next-template-3">
         <div class="icon box-30 "> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 91.6"><polygon class="fill-primary" points="27.49 45.8 2.5 2.5 77.5 45.8 2.5 89.1 27.49 45.8"/></svg></div>
       </span>
     </div> -->
   </div>
   {{-- <div class="custom-owl-nav-3 bg-danger overflow-visible position-absolute w-100"></div> --}}
  </div>


  <div class="home-content  bg-white ">
    <div class="bg-dark-light d-noneeee ">
      <div class="container pt-4 pt-lg-5"> 
        <div class="row mx-0">
          <div class="col-lg-12 mx-auto px-0 ">

            <div class="owl-carousel-links overflow-hidden has-show-on-hover owl-theme owl-loaded parallax-banner position-relative"
             style="background:url('images/bg/bg0.jpg'); background-size:cover; background-repeat: no-repeat;" data-offset="600px" data-rate="0.15">
              <div class="owl-stage-outer " >
                <div class="owl-stage " style="display:flex">
                  @foreach($home_links as $key => $home_link)
                  <div class="owl-item p-3  has-hover-bounce  position-relative" >
                     <div class="box-shadow-slight has-shifting-underline zoom-container border-bottom-primary border-width-3">
                        <div class="position-relavite overflow-hidden box-shadow text-white d-flex align-items-center text-bold">
                          <div class="full-hd-container background-image image" 
                            style="background-image:url('{{asset('uploads/more-infos/'.$home_link->info->photo_url)}}')">
                            <div class="h-100 w-100 position-absolute top-left faded bg-primary"></div>
                          </div>
                          <h5 class="position-absolute p-3">
                            <div>{{$home_link->info->title}} </div>
                            <div class="d-flex w-100">
                              <div class="shifting-underline-1 padding-1 bg-secondary"></div>
                              <div class="shifting-underline-2 padding-1 bg-primary"></div>
                            </div>
                          </h5>
                        </div>

                        <div class="has-last-no-border box-shadow">
                          @foreach($home_link->links as $key => $link)
                            <?php
                              $target=null;
                              if(isset($link->url)) {
                                if(strpos($link->url, 'http') !== false) {$target="target='_blank'";  }
                                $url=$link->url;
                              } 
                              else {$url = "licensed-entities/".$link->slug;}
                            ?>
                            <div class="bg-white">
                              <a class="d-block position-relative hover-bg py-2 has-text-hover-primary px-3 border-bottom" {{$target}} href="{{$url}}">
                                <span class="text-dark text-hover-primary">{{$link->title}}</span>
                              </a>
                            </div>
                           
                          @endforeach
                        </div>
                    </div>
                  </div>
                  @endforeach
                </div>
                <div class="owl-controls  pt-4"></div>
                <!-- get button here -->
                <!-- <div class="d-none " >
                  <span class="hover-icon-left show-on-hover owl-prev-template-links">
                    <div class="icon box-30"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 91.6"><polygon class="fill-primary"  points="52.51 45.8 77.5 2.5 2.5 45.8 77.5 89.1 52.51 45.8"/></svg></div>
                  </span>
                  <span class="hover-icon-right show-on-hover owl-next-template-links">
                    <div class="icon box-30 "> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 91.6"><polygon class="fill-primary" points="27.49 45.8 2.5 2.5 77.5 45.8 2.5 89.1 27.49 45.8"/></svg></div>
                  </span>
                </div> -->
              </div>
              <div class="custom-owl-nav-links bg-danger overflow-visible position-absolute w-100"></div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="bg-white py-4">
      <div class="container">
        <div class="mb-3 text-center pt-3 max-width-680">
          <h5 class="text-bold text-primary mb-3">{{$tira_leadership->title}} </h5>
          <div class="rich-text">{!!$tira_leadership->content!!} </div>
        </div>
        <div class="owl-carousel-leaders overflow-hidden has-show-on-hover owl-theme owl-loaded parallax-banner position-relative"
        style="background:url('images/bg/bg0.jpg'); background-size:cover; background-repeat: no-repeat;" data-offset="600px" data-rate="0.15">
         <div class="owl-stage-outer " >
           <div class="owl-stage " style="display:flex">
             @foreach($leaders as $key => $leader)
             <div class="owl-item p-3  has-hover-bounce  position-relative" >
                <div class="has-shifting-underline zoom-container">
                  <div class="box-150 border-faded mx-auto round box-shadow position-relavite overflow-hidden d-flex flex-column align-items-center">
                    <div class="background-image image h-100 w-100" 
                      style="background-image:url('{{asset('uploads/administration/'.$leader->member->photo_url)}}')">
                    </div>
                  </div>
                  <div class="mx-auto max-width-200">
                    <div class="d-flex w-100 mt-3">
                      <div class="shifting-underline-1 padding-1 bg-secondary"></div>
                      <div class="shifting-underline-2 padding-1 bg-primary"></div>
                    </div>
                    <h6 class="text-center px-3 pt-2">
                      <div class="text-bold">{{$leader->member->fullname}} </div>
                      <div class="faded small mt-1"> {{$leader->member->title}} </div>
                    </h6>
                  </div>
               </div>
             </div>
             @endforeach
           </div>
           <div class="owl-controls  pt-4"></div>
           <!-- get button here -->
           <div class="d-none " >
             <span class="hover-icon-left show-on-hover owl-prev-template-leaders">
               <div class="icon box-30"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 91.6"><polygon class="fill-primary"  points="52.51 45.8 77.5 2.5 2.5 45.8 77.5 89.1 52.51 45.8"/></svg></div>
             </span>
             <span class="hover-icon-right show-on-hover owl-next-template-leaders">
               <div class="icon box-30 "> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 91.6"><polygon class="fill-primary" points="27.49 45.8 2.5 2.5 77.5 45.8 2.5 89.1 27.49 45.8"/></svg></div>
             </span>
           </div>
         </div>
         <div class="custom-owl-nav-leaders bg-danger overflow-visible position-absolute w-100"></div>
       </div>
      </div>

    </div>

    <div class="bg-dark-light pt-4 pb-5 parallax-banner position-relative d-noneeee" style="background:urllll({{asset('site/images/bg/bg6.jpg')}}); background-size:cover; background-repeat: no-repeat;" 
      data-offset="250px" data-rate="0.2">
      <div class="bg-gradient-transparent-white-faded position-absolute top-left h-100 w-100" style="opacity:0.7"></div>
      <div class="container has-shifting-underline">
          <div class=" overflow-hidden px-3">
            <div class="pb-3 text-center pt-3 max-width-680">
              <h5 class="text-bold text-black mb-3">{{$tira_latest_news->title}} </h5>
              <div class="rich-text">{!!$tira_latest_news->content!!} </div>
            </div>

            <div class="row position-relative pt-2 mx-0">
              @if(count($news_list))
              <?php $news = $news_list[0] ?>
              <div class="col-md-6 col-lg-6 d-flex px-0 pr-lg-4  flex-column justify-content-between">
                <div class="box-shadow h-100 mb-4 rounded-smallll border-none overflow-hidden  bg-white show-more-content-news">
                  <a href="{{url('/news/'.$news->slug)}}" class="zoom-container">
                    <div class="overflow-hidden full-hd-container position-relative bg-secondary">
                      <img class="card-img-top image" src="{{asset('uploads/news/'.$news->photo_url)}}" alt="Card image cap">
                      <div class="dark-overlay"></div>
                    </div>
                    <div class="position-relative h-100">
                      <div class="p-3 px-4 bg-white content text-dark">
                        <div class="">
                          <h6 class="card-text text-muted pb-3 small text-primary">{!! date('d M Y', strtotime($news->created_at)) !!} </h6>
                          <h6 class="card-text text-bold">{{str_limit($news->title,40)}}</h6>                                    
                        </div>  
                        <div class="card-text px-4 more-content">
                          <div class="text"> {{str_limit(strip_tags($news->content),80)}} </div>
                        </div> 
                      </div>                               
                    </div>
                  </a>
                </div>
              </div>
              <div class="col-md-6 col-lg-6 d-flex px-0 px-md-3  pb-3 mb-1 pl-lg-3 flex-column ">
                @foreach($news_list as $key => $news)
                  @if($key > 0)
                    <a href="{{url('/news/'.$news->slug)}}" class="col mb-1 cursor-pointer zoom-container show-more-content-news p-0 d-flex border-bottom box-shadow  bg-white last-no-border align-items-center "  style="min-height:140px"> 
                      <div class="col-3 col-md-4 px-0 text-center d-flex flex-column justify-content-center pr-0 border-rightt " >
                        <div class="overflow-hidden box-shadow-slight">
                          <div class="square-container  image my-0 hover-text-primary background-image" 
                            style="background-image:url('{{asset('/uploads/news/'.$news->photo_url)}}'); " >  
                            <div class="dark-overlay"></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-9 col-md-8 pl-3 "> 
                        {{-- <h6> <span class="text-bold">{{str_limit($news->title,40)}}</span> </h6>  --}}
                        <div class=""><span class="small text-faded ">{!! date('d M Y', strtotime($news->created_at)) !!}</span></div>
                        <div class="hover-text-primary ">{{str_limit(strip_tags($news->title),60)}}</div>
                      </div>
                    </a>
                  @endif
                @endforeach
              </div>
            </div>
            @endif
          </div>          
      </div>
    </div>

    
    <div class="bg-white py-4">
      <div class="container">
        <div class="mb-3 text-center pt-3 max-width-680">
          <h5 class="text-bold text-primary mb-3">{{$tira_online_services->title}} </h5>
          <div class="rich-text">{!!$tira_online_services->content!!} </div>
        </div>

        <div class="owl-carousel-services overflow-hidden has-show-on-hover owl-theme owl-loaded  position-relative">
          <div class="owl-stage-outer " >
            <div class="owl-stage " style="display:flex">
              @foreach($services as $key => $service) 
                <div class="owl-item text-center has-hover-bounce has-shifting-underline last-no-border-element text-center position-relative" >
                  <a href="{{isset($service->url)? $service->url : url('/services/'.$service->slug)}}" @if(isset($service->url)) target="_blank" @endif class="d-block">
                    <div class="my-5 pt-4 bg-primaryy d-flex justify-content-center position-relative align-items-center ">
                      <div class="ring d-flex position-absolute justify-content-center align-items-center m-auto border-color-secondary box-110"  >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 91.6 105.77"><polygon class="stroke-primary" 
                          points="89.1 77.89 89.1 27.89 45.8 2.89 2.5 27.89 2.5 77.89 45.8 102.89 89.1 77.89"/></svg>
                      </div>
                      <div class="ring d-flex position-absolute justify-content-center align-items-center m-auto  box-110">
                        <div class="h-100 w-100 position-relative d-inline-block" 
                        style="background-image:url('{{asset('uploads/services/'.$service->photo_url)}}'); background-size:cover; background-position: center; 
                        left:12px; top:5px; clip-path: url(#clip-polygon-1);">
                          <!-- clipath -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="position-absolute top-right" viewBox="0 0 86.6 100">
                            <clipPath id="clip-polygon-1" class="box-110"> 
                              <polygon class="fill-primary-faded" points="86.6 75 86.6 25 43.3 0 0 25 0 75 43.3 100 86.6 75"/>
                            </clipPath>
                          </svg>
                          <!--  -->
                        </div> 
                      </div>
                      <div class="ring d-flex position-absolute justify-content-center align-items-center m-auto box-90">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 86.6 100">
                          <polygon class="fill-primary-faded"points="86.6 75 86.6 25 43.3 0 0 25 0 75 43.3 100 86.6 75"/>
                        </svg>
                      </div>
                      <img src="{{asset('uploads/services/'.$service->icon)}}" class="hover-bounce white-icon" style="width: 40px; height:auto">
                    </div> 
                    <div class="position-relative pt-3"> 
                      <div class="border-element mt-5 mx-auto  position-absolute faded" 
                        style="width:40%;  right:0; left:0; bottom:0;">
                        <div class="d-flex w-100">
                          <div class="shifting-underline-1 padding-1 bg-secondary"></div>
                          <div class="shifting-underline-2 padding-1 bg-primary"></div>
                        </div>
                      </div>
                    </div>
                    <div class="text-bold text-dark mt-3">
                      <span class="bg-white-transparentt d-inline-block p-1 rounded-slight">
                        <span class="px-1"> {{$service->title}} </span>  
                      </span>
                    </div>
                  </a>
                </div>
              @endforeach
            </div>
            <div class="owl-controls  pt-4"></div>
            <!-- get button here -->
            <div class="d-none " >
              <span class="hover-icon-left show-on-hover owl-prev-template-services">
                <div class="icon box-30"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 91.6">
                  <polygon class="fill-primary"  points="52.51 45.8 77.5 2.5 2.5 45.8 77.5 89.1 52.51 45.8"/></svg>
                </div>
              </span>
              <span class="hover-icon-right show-on-hover owl-next-template-services">
                <div class="icon box-30 "> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 91.6">
                  <polygon class="fill-primary" points="27.49 45.8 2.5 2.5 77.5 45.8 2.5 89.1 27.49 45.8"/></svg>
                </div>
              </span>
            </div>
          </div>
          <div class="custom-owl-nav-services bg-danger overflow-visible position-absolute w-100"></div>
        </div>

       
      </div>

    </div>

    <div class="bg-dark-lightt py-4 pb-lg-4 position-relative parallax-banner position-relative " data-offset="600px" data-rate="0.15"
      style="background:url({{asset('site/images/svgs/dark-blue-bg.svg')}}); background-size:cover; background-repeat: repeat;">
      <div class="bg-gradient-transparent-white-faded position-absolute top-left h-100 w-100" style="opacity:0.3; transform:scaleY(1)"></div>
      {{-- <div class="bg-secondary position-absolute top-left h-100 w-100" style="opacity:0.1; transform:scaleY(1)"></div> --}}

      <div class="container">
        <div class="pb-3 text-center text-white pt-3 max-width-680">
          <h5 class="text-bold mb-3">{{$tira_partners->title}} </h5>
          <div class="rich-text">{!!$tira_partners->content!!} </div>
        </div>

        <div class="row">
          <div class="col-lg-12 ">
            <div class="owl-carousel-partners overflow-hidden has-show-on-hover owl-theme bg-none owl-loaded position-relative">
              {{-- <div class="bg-white h-100 w-100 position-absolute top-left faded"></div> --}}
              <div class="owl-stage-outer " >
                <div class="owl-stage " style="display:flex">
                  @foreach($partners as $key => $partner)
                    <div class="owl-item text-center p-2 has-hover-bounce last-no-border-element has-shifting-underline text-center position-relative" >
                      <a target="_blank" rel="noopener noreferrer"  href="{{$partner->url}}" class="d-block max-width-260 p-3 ml-lg-0 bg-gradient-primary-secondary-transparent">
                        <div class="bg-white p-2 overflow-hidden zoom-container"> 
                          <img class="pr-1 py-2 max-width-120 image" style="" src="{{asset('uploads/partners/'.$partner->photo_url)}}">
                        </div>
                        {{-- <div class="d-flex w-100 mt-3">
                          <div class="shifting-underline-1 padding-1 bg-secondary"></div>
                          <div class="shifting-underline-2 padding-1 bg-primary"></div>
                        </div> --}}
                        <div class="mt-3 text-bold text-white" > {{ $partner->title}} </div>
                      </a>
                    </div>
                  @endforeach
                </div>
                <div class="owl-controls  pt-2"></div>
                <!-- get button here -->
                <!-- <div class="d-none " >
                  <span class="hover-icon-left show-on-hover owl-prev-template-partners">
                    <div class="icon box-30"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 91.6"><polygon class="fill-primary"  points="52.51 45.8 77.5 2.5 2.5 45.8 77.5 89.1 52.51 45.8"/></svg></div>
                  </span>
                  <span class="hover-icon-right show-on-hover owl-next-template-partners">
                    <div class="icon box-30 "> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 91.6"><polygon class="fill-primary" points="27.49 45.8 2.5 2.5 77.5 45.8 2.5 89.1 27.49 45.8"/></svg></div>
                  </span>
                </div> -->
              </div>
              <div class="custom-owl-nav-partners bg-danger overflow-visible position-absolute w-100"></div>
            </div>

          </div>
        </div>
      </div>
    </div>


@if(count($latest_videos))
    <div class="bg-dark-light py-4 py-lg-5 pb-lg-4 position-relative">
      <div class="bg-gradient-transparent-white-faded position-absolute top-left h-100 w-100" style="opacity:1; transform:scaleY(1)"></div>
      <div class="container pt-3">

        {{-- <div class="pb-3 text-center pt-3 max-width-680">
          <h5 class="text-bold mb-3">{{$tira_partners->title}} </h5>
          <div class="rich-text">{!!$tira_partners->content!!} </div>
        </div> --}}

	
        <div class="row pt-3"> 
          <div class="col-lg-12 section-heading has-shifting-underline ">
            <div class="owl-carousel-videos overflow-hidden owl-theme owl-loaded parallax-banner position-relative bg-none">
              <!-- <div class="bg-radial-gradient-transparent-white h-100 w-100 position-absolute top-left"></div> -->
              <!-- <div class="bg-white h-100 w-100 position-absolute top-left faded"></div> -->
              <div class="owl-stage-outer overflow-hidden  " >
           
                <div class="owl-stage " style="display:flex"> 
                  @foreach($latest_videos as $key => $video) 
                   @if(strlen($video->title))

                      <div class="owl-item text-center has-hover-bounce last-no-border-element text-center position-relative  px-2 px-md-4" >
                        <div class="p-3 ml-lg-0 bg-gradient-primary-secondary-transparent">
                          <div class="bg-white has-display-on-hover">
                            <a  target="_blank" rel="noopener noreferrer" href="{{$video->url}}" 
                            class="popup-youtube zoom-container overflow-hidden hover-bg d-block box-shadow-slight pointer-hover position-relative ">
                              <div class="full-hd-container overflow-hidden position-relative d-flex align-items-center justify-content-center"> 
                                  <div class="position-absolute h-100 w-100 background-image image" 
                                  style="background-image: url({{ youtube_thumbnail($video->url) }});"></div>
                                  <div class="play-bg d-flex align-items-center justify-content-center bg-primary position-relative">
                                    <i class="fa fa-expand"></i>
                                    <i class="fa fa-play"></i>
                                  </div>  
                                  <div class="container-overlay position-absolute w-100 h-100"></div> 
                                  <div class="small text-white faded text-right position-absolute p-2 w-100 item-date">{!! date('jS M, Y', strtotime($video->created_at)) !!}</div>  
                              </div> 
                              
                              <div class="position-relative bg-white">
                                <div class="move-up text-dark top-left  display-on-hover rounded-bottom-slight p-2 px-lg-3">
                                    <div> {{str_limit($video->title,60)}} </div>                        
                                </div>
                              </div>
                            
                            </a>
                          </div>  
                        </div>
                      </div>
                    @endif
                  @endforeach
                </div>
               
                <div class="owl-controls pt-4 show-on-hover"></div>
                <!-- get button here -->
                <!-- <div class="d-none " >
                  <span class="hover-icon-left owl-prev-template-videos">
                    <div class="icon box-30"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 91.6"><polygon class="fill-secondary"  points="52.51 45.8 77.5 2.5 2.5 45.8 77.5 89.1 52.51 45.8"/></svg></div>
                  </span>
                  <span class="hover-icon-right owl-next-template-videos">
                    <div class="icon box-30 "> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 91.6"><polygon class="fill-secondary" points="27.49 45.8 2.5 2.5 77.5 45.8 2.5 89.1 27.49 45.8"/></svg></div>
                  </span>
                </div> -->
              </div>
               <!-- <div class="custom-owl-nav-videos bg-danger overflow-visible position-absolute w-100"></div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif



  </div>
</div>

@stop

