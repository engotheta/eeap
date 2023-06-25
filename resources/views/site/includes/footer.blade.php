
<footer class="site-footer parallax-banner  pb-0 pt-5  position-relative"
  style="background:url({{asset('site/images/bg/bg7.jpg')}}); background-size:cover; background-repeat: no-repeat;"
  data-offset="400px" data-rate="0.1">

  <div class="bg-gradient-with-transparent h-100 w-100 bg position-absolute top-left"> </div>
  <span class="scroll-to-top has-hover-bounce bg-none border-0 text-white cursor-pointer  " style="transform:translateY(-45px)">
    <div class="p-2 round d-flex justify-content-center position-relative align-items-center box-60">
      <div class="round border-width-3 border border-color-secondary d-flex position-absolute 
          justify-content-center align-items-center m-auto  borderrr  box-70"  >
      </div>
      <div class="bg-white round d-flex position-absolute justify-content-center align-items-center m-auto box-60"  >
      </div>
      <span class="d-inline-block box-40 position-relative z-index-2" style="transform: scaleY(-1); top:-10px">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 90.55 50.67" class="hover-bounce" ><polygon class="stroke-secondary" points="45.27 17.54 1.97 1.97 45.27 48.69 88.58 1.97 45.27 17.54"/></svg>
      </span>
    </div> 
  </span>
  <div class="main-container container px-lg-5">
    <div class="row pb-3">

      <div class="col-lg-7">
        <div class="row">
          <div class="col-md-7 text-center text-lg-left  has-shifting-underline">
            @if (!empty($headquarter))
              <h6 class="footer-heading position-relative text-white d-inline-block pb-2 mb-4 text-uppercase">
                {{label('lbl_contact')}}
                <div class="d-flex w-100  position-absolute bottom-left">
                  <div class="shifting-underline-1 padding-1 bg-secondary"></div>
                  <div class="shifting-underline-2 padding-1 bg-primary"></div>
                </div>
              </h6>   
              <p class="my-1">{{ label('lbl_site_title') }}</p>
              <p class="my-1">{{ label('lbl_site_subtitle') }} </p>
              @if($headquarter->physical_address)
                <p class="my-1 mb-3">{!! $headquarter->physical_address !!}</p>
              @endif
              @if ($headquarter->email)
              <p class="my-1"><span class="text-faded fa fa-envelope mr-2"></span> 
                <a href="mailto:{{ $headquarter->email }}">{{ $headquarter->email }}</a>
              </p>
              @endif
              @if ($headquarter->toll_free)
                <p class="my-1">
                  <i class="fa fa-phone mr-2"></i>
                  <a href="tel:{{ $headquarter->toll_free }}">{{ $headquarter->toll_free }}</a>
                </p>
              @endif
              @if ($headquarter->phone)
                <p class="my-1">
                  <i class="fa fa-mobile-alt mr-2"></i>
                  <a href="tel:{{ $headquarter->phone }}">{{ $headquarter->phone }}</a>
                </p>
              @endif
              @if ($headquarter->fax)
                <p class="my-1">
                  <i class="fa fa-fax mr-2"></i>
                  <a href="fax:{{ $headquarter->fax }}">{{ $headquarter->fax }}</a>
                </p>
              @endif
            @endif
          </div>
    
          <div class="col-md-5 no-padding-sm text-center pl-lg-4 mt-4 mt-md-0 text-lg-left has-shifting-underline">
            <h6 class="footer-heading position-relative text-white d-inline-block pb-2 mb-4 text-uppercase">
              {{label('lbl_quick_links')}}
              <div class="d-flex w-100  position-absolute bottom-left">
                <div class="shifting-underline-1 padding-1 bg-secondary"></div>
                <div class="shifting-underline-2 padding-1 bg-primary"></div>
              </div>
            </h6>
            @foreach ($quickLinks as $key => $link) 
              @break($key > 10)
              <div class="pr-1 py-1"><a rel="noopener noreferrer" href="{{ url($link->url) }}"> {{$link->title}} </a></div>      
            @endforeach               
          </div>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="row mt-lg-0 mt-md-5 mt-0">
          <div class="col-md-6 no-padding-sm text-center text-lg-left has-shifting-underline">
            <h6 class="footer-heading position-relative text-white d-inline-block pb-2 mb-4 text-uppercase">
              {{label('lbl_media_center')}}
              <div class="d-flex w-100  position-absolute bottom-left">
                <div class="shifting-underline-1 padding-1 bg-secondary"></div>
                <div class="shifting-underline-2 padding-1 bg-primary"></div>
              </div>
            </h6>  
            @foreach ($mediaLinks as $key => $link) 
              @break($key > 10)
              <div class="pr-1 py-1"><a @if($link->link == 0)  rel="noopener noreferrer" @endif href="{{ url($link->url) }}"> {{$link->title}} </a></div>
            @endforeach
          </div>
        
          <div class="col-md-6 no-padding-sm text-center mt-4 mt-md-0 text-lg-left has-shifting-underline">
            <h6 class="footer-heading position-relative text-white d-inline-block pb-2 mb-4 text-uppercase">
              {{label('lbl_important_links')}}
              <div class="d-flex w-100  position-absolute bottom-left">
                <div class="shifting-underline-1 padding-1 bg-secondary"></div>
                <div class="shifting-underline-2 padding-1 bg-primary"></div>
              </div>
            </h6>
            @foreach ($importantLinks as $key => $link) 
              @break($key > 10)
              <div class="pr-1 py-1"><a target="_blank" rel="noopener noreferrer" href="{{ $link->url }}"> {{$link->title}} </a></div>      
            @endforeach               
          </div>
        </div>
      </div>

     
    </div>

    <div class="col-12 p-0 container d-block d-lg-none mb-2">
      @if (count($social_links) > 0)
        <h4 class="footer-media text-center pt-4 pb-0 mb-0">
          @forelse($social_links as $social_link)
              @if($social_link->title_en == 'facebook')
                <a href="{{ $social_link->url }}" target="_blank" rel="noopener noreferrer"><i class="fab icon fa-facebook-f px-2" aria-hidden="true"></i></a>
              @endif
              @if($social_link->title_en == 'twitter')
                <a href="{{ $social_link->url }}" target="_blank" rel="noopener noreferrer"><i class="fab icon fa-twitter  px-2" aria-hidden="true"></i></a>
              @endif
              @if($social_link->title_en == 'youtube')
                <a href="{{ $social_link->url }}" target="_blank" rel="noopener noreferrer"><i class="fab icon fa-youtube  px-2" aria-hidden="true"></i></a>
              @endif
              @if($social_link->title_en == 'linkedIn')
                <a href="{{ $social_link->url }}" target="_blank" rel="noopener noreferrer"><i class="fab icon fa-linkedin-in  px-2" aria-hidden="true"></i></a>
              @endif
              @if($social_link->title_en == 'blog')
                <a href="{{ $social_link->url }}" target="_blank" rel="noopener noreferrer"><i class="fab icon fa-blogger-b  px-2" aria-hidden="true"></i></a>
              @endif
              @if($social_link->title_en == 'whatsapp')
                <a href="{{ $social_link->url }}" target="_blank" rel="noopener noreferrer"><i class="fab icon fa-whatsapp  px-2" aria-hidden="true"></i></a>
              @endif
              @if($social_link->title_en == 'vimeo')
                <a hrf="{{ $social_link->url }}" target="_blank" rel="noopener noreferrer"><i class="fab icon fa-vimeo  px-2" aria-hidden="true"></i></a>
              @endif
              @if($social_link->title_en == 'skype')
                <a href="{{ $social_link->url }}" target="_blank" rel="noopener noreferrer"><i class="fab icon fa-skype  px-2" aria-hidden="true"></i></a>
              @endif
              @if($social_link->title_en == 'tumblr')
                <a href="{{ $social_link->url }}" target="_blank" rel="noopener noreferrer"><i class="fab icon fa-tumblr  px-2" aria-hidden="true"></i></a>
              @endif
              @if($social_link->title_en == 'snapchat')
                <a href="{{ $social_link->url }}" target="_blank" rel="noopener noreferrer"><i class="fab icon fa-snapchat  px-2" aria-hidden="true"></i></a>
              @endif
              @if($social_link->title_en == 'flickr')
                <a href="{{ $social_link->url }}" target="_blank" rel="noopener noreferrer"><i class="fab icon fa-flickr  px-2" aria-hidden="true"></i></a>
              @endif
              @if($social_link->title_en == 'instagram')
                <a href="{{ $social_link->url }}" target="_blank" rel="noopener noreferrer"><i class="fab icon fa-instagram  px-2" aria-hidden="true"></i></a>
              @endif
            @endforeach
        </h4>
      @endif
    </div>
  </div>



  <div class="site-info bg-primary border-top-secondary position-relative z-index-2"> 


    <div class="col-md-12 pl-0 list no-padding-sm text-center  footer-links footer-nav p-3">
      <ul class="list-inline mb-0">
        {!! App\Models\MenuItem::getMenu('footer_menu') !!}
      </ul>
    </div>
    <div class="copyright text-white-50 p-3 footer-nav">
        <div class="text-white-50 text-center">
          © {{ date('Y') }} {{ label('lbl_site_title_short')}}, {{ label('lbl_copyright')}}
        </div>
    </div>
  </div>
</footer>

