
<div class="d-none d-md-block sticky-top " style="z-index:0 !important">
  <div class="pressside mb-3 has-shifting-underline">
    <div class="pressside-heading text-primary border-bottom-fadeddd p-1 px-2">
      <h5 class="pb-3 pb-lg-3 section-heading"> 
        <a  href="{{url('/news')}}" class=" pb-2 text-uppercase text-primary hover-text-primary 
         d-block position-relative"> 
          <!-- <i class="fa fa-cog pr-2  align-self-center"></i>  -->
          <span class="d-inline-block py-2 position-relative text-bold text-primary">
            <span class="px-2222">{{label('lbl_news_and_events')}}</span>
          </span>
          <div class="d-flex w-100 position-absolute bottom-left">
            <div class="shifting-underline-1 padding-1 bg-secondary"></div>
            <div class="shifting-underline-2 padding-1 bg-primary"></div>
          </div>
        </a>
      </h5>
    </div>
  
    <div class="pressside-body p-2  ">
      <?php $key_ = -1?>
      @foreach($news_and_events as $key => $news_or_event)
        @break(++$key_ > 1)
        <?php $type = isset($news_or_event->event_date)? 'events':'news'?>
        <a href="{{url($type.'/'.$news_or_event->slug)}}" class="col mb-1 cursor-pointer zoom-container show-more-content-news p-2 d-flex border-bottom box-shadow  bg-white last-no-border align-items-center "  style="min-height:110px"> 
            <div class="col-3 col-md-4 px-lg-3 text-center d-flex flex-column justify-content-center pr-0 border-rightt " >
                <div class="border-faded p-1">
                  <div class="overflow-hidden box-shadow-slight">
                    <div class="full-hd-container  image my-0 hover-text-primary background-image" 
                      style="background-image:url('{{asset('uploads/'.$type.'/'.$news_or_event->photo_url)}}'); " >  
                      <div class="dark-overlay"></div>
                    </div>
                  </div>
                </div>
               
              </div>
 
          <div class="col-9 col-md-8 pl-3 text-left "> 
            <?php  $date = $type=='events'? $news_or_event->event_date : $news_or_event->created_at; ?>
            <div class="">
              <span class="small text-faded "> {!! date('d M Y', strtotime($date)) !!} | <span class="text-uppercase">{{$type}}</span></span>
            </div>
            <div class="hover-text-primary ">{!! str_limit(strip_tags($news_or_event->title), 60) !!} </div>
            {{-- <div class="text-uppercase text-muted small ">{{$type}}</div> --}}
          </div>
        </a>
      @endforeach
    </div>
  
    <div class="pressside-footer  p-2 px-md-2 d-flex justify-content-end">
        <a href="{{url('/news')}}" class="readmore bg-white border d-inline-block px-3 py-2 rounded-mediumm  box-shadow-slight text-primary hover-bg-primary cursor-pointer  ">
          <span>{{label('lbl_news')}} </span>
          <i class="fa fa-chevron-right"></i>
        </a> 
        {{-- <a href="{{url('/eventes')}}" class="readmore bg-white border d-inline-block px-3 py-2 rounded-mediumm  box-shadow-slight text-primary hover-bg-primary cursor-pointer  ">
          <span>{{label('lbl_events')}} </span>
          <i class="fa fa-chevron-right"></i>
        </a>      --}}
    </div>
  
  </div>
  
  <div class="pressside  has-shifting-underline">
  
    <div class="pressside-heading  p-2 text-primary border-bottommm">
      <h5 class="pb-3 pb-lg-3 section-heading"> 
        <a  hreffff="{{url('/publications')}}" 
        class="  pb-2  text-uppercase text-primary hover-text-primary bg-white-transparent-hover-secondary
         d-block position-relative"> 
          <!-- <i class="fa fa-cog pr-2  align-self-center"></i>  -->
          <span class="d-inline-block py-2 position-relative text-bold text-primary">
            <span class="px-2222">{{label('lbl_latest_documents')}}</span>
          </span>
          <div class="d-flex w-100 position-absolute bottom-left">
            <div class="shifting-underline-1 padding-1 bg-secondary"></div>
            <div class="shifting-underline-2 padding-1 bg-primary"></div>
          </div>
        </a>
      </h5>
    </div>
  
    <div class="pressside-body border-leftt p-2">
        <div class="d-flex flex-column h-100 rounded-slightt overflow-hidden">
          @foreach($latest_documents as $key => $doc)
            @break($key > 2)
            <div class="col px-0 last-no-border bg-white-transparent py-0 mb-1 " style="min-height:70px">
              <a href="{!! asset('uploads/documents/'.$doc->file)!!}" class="row h-100 align-items-center
                 mx-0 border-faded box-shadow-slight cursor-pointer hover-bg has-hover-bounce has-hover-text-primary has-hover-text-secondary">
                <div class="padding-2 h-100 text-center border border-color-primary border-width-2">
                  <div class=" bg-primary text-white h-100 px-2   d-flex justify-content-center position-relative align-items-center " >
                    <div class="p-2 round h-100 d-flex justify-content-center position-relative align-items-center boxss-40">
                      <img src="{{asset('site/images/svgs/document.svg')}}" class="hover-bounce filter-white white-icon position-relative z-index-2" style="width: 30px; height:auto">
                    </div> 
                  </div>
                </div>
                <div class="col pl-2 h-100 d-flex align-items-center text-left p-2 " > 
                  <div class="hover-text-primary ">{!! str_limit(strip_tags($doc->title), 40) !!} 
                    {{-- |  <span class="faded">{{ str_limit($doc->category->title,40)}} </span> --}}
                  </div>
                </div>
              </a>
            </div>
          @endforeach
        </div>
    </div>
    <div class="pressside-footer px-2 d-flex justify-content-end">
      <a href="{{url('/announcements')}}" class="readmore border d-inline-block px-3 py-2 rounded-mediumm  box-shadow-slight text-primary hover-bg-primary cursor-pointer  ">
        <span> {{label('lbl_view_all')}}</span>
        <i class="fa fa-chevron-right"></i>
      </a>    
    </div>
  </div>

</div>