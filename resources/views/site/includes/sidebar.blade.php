
<div class="d-none d-md-block sticky-top has-content-title" style="z-index:0 !important">

    <h5 class="ml-lg-4 text-left content-title py-4 mb-4 font-20">{{label('lbl_news_and_events')}}</h5>
  
    <div class="pressside-body p-2  ">
      <?php $key_ = -1?>
      @foreach($news_and_events as $key => $news_or_event)
        @break(++$key_ > 2)
        <?php $type = isset($news_or_event->event_date)? 'events':'news'?>
        <a href="{{url($type.'/'.$news_or_event->slug)}}" class="col mb-2  rounded-small bg-white  
          cursor-pointer zoom-container show-more-content-news p-2 d-flex bg-white align-items-center"  style="min-height:110px"> 
          <div class="col-3 col-md-4 px-lg-3 text-center d-flex flex-column justify-content-center pr-0 " >
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
            <div class="small text-faded "> {!! date('d M Y', strtotime($date)) !!} | <span class="text-uppercase">{{$type}}</span></div>
            <div class="hover-text-primary ">{!! str_limit(strip_tags($news_or_event->title), 60) !!} </div>
          </div>
        </a>
      @endforeach
    </div>
  
    <div class="pressside-footer  p-2 px-md-2 d-flex justify-content-end">
      <a class="d-inline-block p-2 px-4 readmore bg-primary fade-on-hover  text-white position-relative" href="{{url('/news')}}"> 
        {{label('lbl_readmore')}}  <i class="pl-1 icon fa fa-chevron-right"></i>
      </a>
    </div>
  

</div>