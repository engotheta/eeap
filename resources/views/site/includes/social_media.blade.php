<div class="social-media-side d-none d-lg-block mr-4">

  @foreach($social_links as $key => $social_link )
   <div>
      <a target="_blank"  rel="noopener noreferrer" href="{{ $social_link->url }}"
        class="social-media-box mb-1 d-flex align-items-center justify-content-end">
      <div style="transform:translateX(20px)" 
        class="h-40 d-flex align-items-center rounded-left-mediummm social-text bg-primary text-white">
        {{ $social_link->title_en }}
      </div>
      <div class="box-40 position-relative rounddd d-flex box-shadow-slight cursor-pointer justify-content-center
      bg-white border text-primary align-items-center">
        <i class="fab fa-{{$social_link->title_en}}"></i>
      </div>
    </a>
   </div>
   @endforeach

</div>

<div class="d-flex position-fixed bottom-right m-3 m-lg-4 mr-5 align-items-center round bg-primary
text-white has-hover-text-secondary box-shadow-slight p-2 px-3 cursor-pointer box-60 flex-center "
style="z-index: 999; right:14px; bottom:50px ">
  <span class="position-relative flex-center ">
    <i class="fa text-md fa-headphones hover-text-secondary"></i>
    <span class="position-absolute box-35 round border border-color-white expanding-item"></span>
  </span>
</div>




