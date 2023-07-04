
<footer class="site-footer bg-primary text-white parallax-banner  py-5  position-relative"
  style="background:urlll({{asset('site/images/bg/bg7.jpg')}}); background-size:cover; background-repeat: no-repeat;"
  data-offset="400px" data-rate="0.1">
  <div class="container">

    <div class="d-flex w-100 justify-content-between align-items-center pb-4" style="min-height:200px">
      <h3 class="text-bold"> {{ label("lbl_site_title")}}</h3>
      <div class=" d-flex">
        @foreach($social_links as $key => $social_link )
          <a target="_blank"  rel="noopener noreferrer" href="{{ $social_link->url }}" class="flex-center m-1 px-1 ">
           <div class="box-40  hover-bg round d-flex overflow-hidden cursor-pointer justify-content-center  align-items-center">
             <i style="font-size:24px" class="fab   text-white fa-{{$social_link->title_en}}"></i>
           </div>
         </a>
        @endforeach
      </div>
    </div>
  

    <div class="site-info bg-primary border-top border-color-white d-flex pt-5 w-100 justify-content-between align-items-center
      position-relative z-index-2"> 

      <div class="text-white-50">  © {{ date('Y') }} {{ label('lbl_site_title')}}, {{ label('lbl_copyright')}} </div>

      <div class="footer-links footer-nav p-3">
        <ul class="list-inline mb-0"> {!! App\Models\MenuItem::getMenu('footer_menu') !!} </ul>
      </div>
     
    </div>
  </div>

</footer>

