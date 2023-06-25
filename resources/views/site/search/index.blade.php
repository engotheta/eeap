@extends('site.inner')

@section('title')
  {!! label('lbl_search') !!}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">{{ label('lbl_search') }}</li>
@endsection

{{-- @section('page_title')
{!! label('lbl_search') !!}
@endsection --}}


@section('css-content')
<style type="text/css">
  .highlighted {
    background-color:tan;
    border-radius: 5px;
  }

  .search-highlight p{
    margin-bottom: 3px !important;
  }

  .border-search{
    border: 1px solid var(--primary-color);
  }

  #search_nav_sm{
    padding: 15px 0px;
    z-index:0 !important;
  }

  #search_nav_sm a{
    border: 1px solid #ccc;
    padding: 5px;
    margin-right: 5px;
    margin-bottom:5px;
  }
  
  #search_nav_sm a.active{
    font-weight:bold;
    background-color:var(--primary-color);
    color:#fff;
  }

</style>
@endsection

@section('page_content')

<div class="about-page main-container container-fluid  bg-white">
  <div class="col-12 px-0">
    <div class="row mx-0">
      <div class="col-lg-12 px-0 my-2 page-content">

        <div class="row mx-0 has-shifting-underline">

          <div class="col-12 py-1 px-0 ">
            <h5 class="pb-2 position-relative page-title text-uppercase text-primary hover-text-primary"> 
              <span class="d-inline-block py-2 position-relative text-bold text-primary">
                <span class="px-2222">{{ label('lbl_search') }}</span>
              </span>
              <div class="d-flex w-100 position-absolute bottom-left">
              <div class="shifting-underline-1 padding-1 bg-secondary"></div>
              <div class="shifting-underline-2 padding-1 bg-primary"></div>
              </div>
            </h5>   
          </div>

          <div class="col-12 mt-4 col-md-4 px-0 pb-3">
            <div class="sticky-top" id="search_nav_sm">
              <a href="#"  data-show-only="press-release" class="d-inline-block show-results">
                {{ label('lbl_press') }} 
                <span class="badge badge-light bold-600 border-search">{{count($pressResults)}}</span>
              </a>
              {{-- <a href="#"  data-show-only="howdois" class="d-inline-block show-results">
                {{ label('lbl_how_doi') }}
                <span class="badge badge-light bold-600 border-search">{{count($howdoiResults)}}</span>
              </a> --}}
              {{-- <a href="#"  data-show-only="passengers" class="d-inline-block show-results">
                {{ label('lbl_passengers_info') }}
                <span class="badge badge-light bold-600 border-search">{{count($passengerResults)}}</span>
              </a> --}}
              <a href="#"  data-show-only="administration" class="d-inline-block show-results">
                {{ label('lbl_administration') }} 
                <span class="badge badge-light bold-600 border-search">{{count($administrationResults)}}</span>
              </a>
              <a href="#"  data-show-only="news" class="d-inline-block show-results active">
                {{ label('lbl_news') }} 
                <span class="badge badge-light bold-600 border-search">{{count($newsResults)}}</span>
              </a>
              {{-- <a href="#" data-show-only="events-search" class="d-inline-block show-results">
                {{ label('lbl_events') }} 
                <span class="badge badge-light bold-600 border-search">{{count($eventResults)}}</span>
              </a> --}}
              {{-- <a href="#"  data-show-only="announcements" class="d-inline-block show-results active">
                {{ label('lbl_announcements') }} 
                <span class="badge badge-light bold-600 border-search">{{count($announcementResults)}}</span>
              </a> --}}
              {{-- <a href="#"  data-show-only="speeches" class="d-inline-block show-results">
                {{ label('lbl_speeches') }}
                <span class="badge badge-light bold-600 border-search">{{count($speechResults)}}</span>
              </a> --}}
              <a href="#" data-show-only="publications" class="d-inline-block show-results">
                {{ label('lbl_publications') }} 
                <span class="badge badge-light bold-600 border-search">{{count($publicationResults)}}</span>
              </a>
              <a href="#" data-show-only="service" class="d-inline-block show-results">
                {{ label('lbl_our_services') }} 
                <span class="badge badge-light bold-600 border-search">{{count($serviceResults)}}</span>
              </a>
              <a href="#" data-show-only="faqs" class="d-inline-block show-results">
                {{ label('lbl_faq_short') }} 
                <span class="badge badge-light bold-600 border-search">{{count($faqResults)}}</span>
              </a>
              <a href="#" data-show-only="pages" class="d-inline-block show-results">
                {{ label('lbl_pages') }} 
                <span class="badge badge-light bold-600 border-search">{{count($pageResults)}}</span>
              </a>
            </div>
          </div>

          <div class=" col-12 col-md-8 mt-4 bg-white  px-lg-5 page-content" >
            <div class="content-heading text-primary mt-2 font-weight-bold">
              <h5 class="">               
                  {{ label('lbl_search_results') }} <span> <?php echo (curlang() == '_sw')? 'ya':'of'  ?> </span>  <span class="text-gray"> '{{ $term }}' </span>
              </h5>
            </div>
            
            <div class="col-12 px-0  pr-md-5 mt-3">           
              <div style="font-size: 0.8rem;">

                  <div class="press-release d-none p-0">
                    <div class="text-secondary my-2"> 
                      <h5 class="bold-600 bg-light-darker p-2 bottom-line"><span class="fas fa-search"></span> {!! label('lbl_press') !!}</h5>
                    </div>
                    @if(count($pressResults))                      
                      <div class="mt-3">
                      @foreach($pressResults as $press)
                          <a href="{!! URL::to('press-releases', $press->slug) !!}" class="border-bottom gray-border d-block mb-3">
                            <h6 class="mb-1 text-primary bold-600 search-highlight">{{ $press->name }}</h6>                                  
                            <div class="search-highlight">{!! str_limit(strip_tags($press->content),100) !!}</div>
                            <div class=" text-faded"> {{ date('F d, Y',strtotime($press->created_at))}}</div>
                          </a>
                        @endforeach
                      </div>
                      <div class="clearfix mb-3 pb-1"></div>                         
                    @else
                        <h6 class="mb-1 text-primary">{{ label('lbl_no_information') }}</h6> 
                    @endif 
                  </div>

                  {{-- <div  class="howdois d-none">
                    <div class="text-secondary my-2"> 
                      <h5 class="bold-600 bg-light-darker p-2 bottom-line"><span class="fas fa-search"></span> {!! label('lbl_how_doi') !!}</h5>
                    </div>
                    @if(count($howdoiResults))
                      <div class="mt-3">
                        @foreach($howdoiResults as $howdoi)
                          <a href="{!! URL::to('howdois', $howdoi->slug) !!}" class="border-bottom gray-border d-block mb-3">
                            <h6 class="mb-1 text-primary bold-600 search-highlight">{{ $howdoi->title }}</h6>
                            <div class="search-highlight">{!! str_limit(strip_tags($howdoi->content),100) !!}</div>
                          </a>
                        @endforeach
                      </div>
                      <div class="clearfix mb-3 pb-1"></div>                    
                    @else
                      <h6 class="mb-1 text-primary">{{ label('lbl_no_information') }}</h6> 
                    @endif 
                  </div> --}}

                  {{-- <div  class="passengers d-none">
                    <div class="text-secondary my-2">
                      <h5 class="bold-600 bg-light-darker p-2 bottom-line"><span class="fas fa-search"></span> {!! label('lbl_passengers_info') !!}</h5>
                    </div>
                    @if(count($passengerResults))
                      <div class="mt-3">
                        @foreach($passengerResults as $passenger)
                          <a href="{!! URL::to('passengers', $passenger->slug) !!}" class="border-bottom gray-border d-block mb-3">
                            <h6 class="mb-1 text-primary bold-600 search-highlight">{{ $passenger->title }}</h6>
                            <div class="search-highlight">{!! str_limit(strip_tags($passenger->content),100) !!}</div>
                          </a>
                        @endforeach
                      </div>
                      <div class="clearfix mb-3 pb-1"></div>
                    @else
                      <h6 class="mb-1 text-primary">{{ label('lbl_no_information') }}</h6>
                    @endif
                  </div> --}}
                  
                  <div class="administration d-none">
                    <div class="text-secondary my-2"> 
                      <h5 class="bold-600 bg-light-darker p-2 bottom-line"><span class="fas fa-search"></span> {!! label('lbl_administration') !!}</h5>
                    </div>
                    @if(count($administrationResults))                      
                      <div class="mt-3">
                      @foreach($administrationResults as $administration)
                          <a href="{!! URL::to('administration/members', $administration->slug) !!}" class="border-bottom gray-border d-block mb-3">
                            <h6 class="mb-1 text-primary bold-600 search-highlight">{{ $administration->salutation.' '.$administration->fullname }}</h6>                                  
                            <div class="search-highlight">{!! str_limit(strip_tags($administration->title),100) !!}</div>
                          </a>
                        @endforeach
                      </div>
                      <div class="clearfix mb-3 pb-1"></div>                         
                    @else
                        <h6 class="mb-1 text-primary">{{ label('lbl_no_information') }}</h6> 
                    @endif 
                  </div>

                  <div class="news d-noneeee has-last-no-border">
                    <div class="text-secondary my-2"> 
                      <h5 class="bold-600 bg-light-darker p-2 bottom-line"><span class="fas fa-search"></span> {!! label('lbl_news') !!}</h5>
                    </div>
                    @if(count($newsResults))                      
                      <div class="mt-3">
                      @foreach($newsResults as $news)
                          <a href="{!! URL::to('news', $news->slug) !!}" class="border-bottom last-no-border gray-border d-block mb-3">
                            <h6 class="mb-1 text-primary bold-600 search-highlight">{{ $news->title }}</h6>                                  
                            <div class="search-highlight">{!! str_limit(strip_tags($news->content),100) !!}</div>
                            <div class="text-faded"> {{ date('F d, Y',strtotime($news->created_at)) }}</div>
                          </a>
                        @endforeach
                      </div>
                      <div class="clearfix mb-3 pb-1"></div>                         
                    @else
                        <h6 class="mb-1 text-primary">{{ label('lbl_no_information') }}</h6> 
                    @endif 
                  </div>

                  {{-- <div  class="events-search d-none">
                    <div class="text-secondary my-2"> 
                      <h5 class="bold-600 bg-light-darker p-2 bottom-line"><span class="fas fa-search"></span> {!! label('lbl_events') !!}</h5>
                    </div>
                    @if(count($eventResults))     
                      <div class="mt-3">
                        @foreach($eventResults as $event)
                          <a href="{!! URL::to('events', $event->slug) !!}" class="border-bottom gray-border d-block mb-3">
                            <h6 class="mb-1 text-primary bold-600 search-highlight">{{ $event->title }}</h6>                                  
                            <div class="search-highlight">{!! str_limit(strip_tags($event->content),100) !!}</div>
                            <div class=" text-faded"> 
                              {{ date('F d, Y',strtotime($event->event_date)) }} - {{ $event->location }}
                            </div>
                          </a>
                        @endforeach
                      </div>
                      <div class="clearfix mb-3 pb-1"></div>                    
                    @else
                      <h6 class="mb-1 text-primary">{{ label('lbl_no_information') }}</h6> 
                    @endif 
                  </div> --}}

                  {{-- <div class="announcements">
                    <div class="text-secondary my-2"> 
                      <h5 class="bold-600 bg-light-darker p-2 bottom-line"><span class="fas fa-search"></span> {!! label('lbl_announcements') !!}</h5>
                    </div>
                    @if(count($announcementResults))                      
                      <div class="mt-3">
                        @foreach($announcementResults as $announcement)
                          <a href="{!! URL::to('announcements', $announcement->slug) !!}" class="border-bottom gray-border d-block mb-3">
                            <h6 class="mb-1 text-primary bold-600 search-highlight">{{$announcement->title }}</h6>                                  
                            <div class="search-highlight">{!! str_limit(strip_tags($announcement->content),100) !!}</div>
                            <div class="text-faded"> {{ date('F d, Y',strtotime($announcement->created_at))}}</div>
                          </a>
                        @endforeach
                      </div>
                      <div class="clearfix mb-3 pb-1"></div>                         
                    @else
                        <h6 class="mb-1 text-primary">{{ label('lbl_no_information') }}</h6> 
                    @endif 
                  </div> --}}

                  {{-- <div class="speeches d-none">
                    <div class="text-secondary my-2"> 
                      <h5 class="bold-600 bg-light-darker p-2 bottom-line"><span class="fas fa-search"></span> {!! label('lbl_speeches') !!}</h5>
                    </div>
                    @if(count($speechResults))                      
                      <div class="mt-3">
                      @foreach($speechResults as $speech)
                          <a href="{!! URL::to('speeches', $speech->slug) !!}" class="border-bottom gray-border d-block mb-3">
                            <h6 class="mb-1 text-primary bold-600 search-highlight">{{ $speech->name }}</h6>                                  
                            <div class="search-highlight">{!! str_limit(strip_tags($speech->content),100) !!}</div>
                            <div class=" text-faded"> {{ date('F d, Y',strtotime($speech->created_at))}}</div>
                          </a>
                        @endforeach
                      </div>
                      <div class="clearfix mb-3 pb-1"></div>                         
                    @else
                        <h6 class="mb-1 text-primary">{{ label('lbl_no_information') }}</h6> 
                    @endif 
                  </div> --}}

                  <div class="publications d-none has-last-no-border">
                    <div class="text-secondary my-2"> 
                      <h5 class="bold-600 bg-light-darker p-2 bottom-line"><span class="fas fa-search"></span> {!! label('lbl_publications') !!}</h5>
                    </div>
                    @if(count($publicationResults))
                      <div class="mt-3">
                        @foreach($publicationResults as $publication)
                          <a target="_blank" href="{!! asset('uploads/documents/'.$publication->{langdb('file')}) !!}" class="border-bottom last-no-border gray-border d-block mb-3">
                            <h6 class="mb-1 text-primary bold-600 search-highlight">{!! $publication->title !!} </h6>                                  
                            <div class=" text-faded"> 
                              <span class="mr-1">{{ date('F d, Y',strtotime($publication->created_at))}} </span> | 
                              <i class="ml-1 fa fa-download"></i> 
                            </div>
                          </a>
                        @endforeach
                      </div>
                      <div class="clearfix mb-3 pb-1"></div>                     
                    @else
                      <h6 class="mb-1 text-primary">{{ label('lbl_no_information') }}</h6> 
                    @endif 
                  </div>

                  <div class="service d-none">
                    <div class="text-secondary my-2"> 
                      <h5 class="bold-600 bg-light-darker p-2 bottom-line"><span class="fas fa-search"></span> {!! label('lbl_our_services') !!}</h5>
                    </div>
                    @if(count($serviceResults))                      
                      <div class="mt-3">
                        @foreach($serviceResults as $service)
                          <a href="{!! URL::to('services', $service->slug) !!}" class="border-bottom gray-border d-block mb-3">
                            <h6 class="mb-1 text-primary bold-600 search-highlight">{{$service->title }}</h6>                                  
                            <div class="search-highlight">{!! str_limit(strip_tags($service->content),100) !!}</div>
                            <div class="text-faded"> {{ date('F d, Y',strtotime($service->created_at))}}</div>
                          </a>
                        @endforeach
                      </div>
                      <div class="clearfix mb-3 pb-1"></div>                         
                    @else
                        <h6 class="mb-1 text-primary">{{ label('lbl_no_information') }}</h6> 
                    @endif 
                  </div>

                  <div  class="faqs d-none has-last-no-border">
                    <div class="text-secondary my-2"> 
                      <h5 class="bold-600 bg-light-darker p-2 "><span class="fas fa-search"></span> {!! label('lbl_faq') !!}</h5>
                    </div>
                    @if(count($faqResults))
                        <div class="mt-3">
                          @foreach($faqResults as $faq)
                            <a href="{!! URL::to('faqs', $faq->slug) !!}" class="border-bottom last-no-border gray-border d-block mb-3">
                              <h6 class="mb-1 text-primary bold-600 search-highlight">{{ $faq->question }}</h6>                                  
                              <div class="search-highlight">{!! str_limit(strip_tags($faq->answer),100) !!}</div>
                            </a>
                          @endforeach
                        </div>
                        <div class="clearfix mb-3 pb-1"></div> 
                    @else
                      <h6 class="mb-1 text-primary">{{ label('lbl_no_information') }}</h6> 
                    @endif 
                  </div>

                  <div  class="pages d-none has-last-no-border">
                    <div class="text-secondary my-2"> 
                      <h5 class="bold-600 bg-light-darker p-2 "><span class="fas fa-search"></span> {!! label('lbl_pages') !!}</h5>
                    </div>
                    @if(count($pageResults))
                        <div class="mt-3">
                          @foreach($pageResults as $page)
                            <a href="{!! URL::to('pages', $page->slug) !!}" class="border-bottom last-no-border gray-border d-block mb-3">
                              <h6 class="mb-1 text-primary bold-600 search-highlight">{{ $page->title }}</h6>                                  
                              <div class="search-highlight">{!! str_limit(strip_tags($page->content),100) !!}</div>
                            </a>
                          @endforeach
                        </div>
                        <div class="clearfix mb-3 pb-1"></div> 
                    @else
                      <h6 class="mb-1 text-primary">{{ label('lbl_no_information') }}</h6> 
                    @endif 
                  </div>
                
              </div>
              
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

@stop

@section('js-content') 

<script type="text/javascript">

   var togglers = document.querySelectorAll('.show-results');
   var showing = document.querySelector('.news'); 


   togglers.forEach((toggler)=>{

     toggler.addEventListener('click', (e)=>{
       e.preventDefault();

       if(!document.querySelector('.'+toggler.dataset.showOnly)) return

        showing.classList.add('d-none');
        showing = document.querySelector('.'+toggler.dataset.showOnly)
        showing.classList.remove('d-none');

        document.querySelector(".show-results.active").classList.remove('active');
        toggler.classList.add("active");
     })
    
     
   });
 
</script>

@endsection