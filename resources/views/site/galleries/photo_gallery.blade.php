@extends('site.inner')

@section('title')
    {!! $gallery->title !!}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('galleries/listing/photos')}}">{{ label('lbl_photo_gallery') }}</a></li>
<li class="breadcrumb-item active" aria-current="page"> {!! str_limit(strip_tags($gallery->title) , 25) !!}  </li>
@endsection

{{-- @section('page_title')
{!! $gallery->title !!}
@endsection --}}

@section('page_content')
<div class="bg-gradient-white-light h-100 w-100 position-absolute top-left"></div>
<div class="about-page main-container container-fluid bg-white">
	<div class="col-12">
	
		<div class="row">
			<div class="col-lg-12 px-0 my-2 page-content has-shifting-underline">
                               
                <div class="col-12 py-1 px-0">
                    <h5 class="pb-2 position-relative page-title text-uppercase text-primary hover-text-primary"> 
                        <span class="d-inline-block py-2 position-relative text-bold text-primary">
                          <span class="px-2222">{!! $gallery->title !!}</span>
                        </span>
                        <div class="d-flex w-100 position-absolute bottom-left">
                        <div class="shifting-underline-1 padding-1 bg-secondary"></div>
                        <div class="shifting-underline-2 padding-1 bg-primary"></div>
                        </div>
                    </h5> 
                </div>
  
				<div class="row mx-0 mt-4">
					
                    <div class="col-12 px-0 d-block border-bottom-faded border-color-secondary">
                        <div class="rich-text pb-3">
                            {!! $gallery->content !!}
                        </div>
                    </div>
                    <div class="col-12 px-0 pt-3">
                        <div class="row gray-border mb-3 photos">
                            @forelse($photos as $key => $photo)                                        
                                <div class="col-md-3 p-2 ">
                                    <a  href="{{asset('uploads/gallery/'.$photo->filename)}}" class="media-container box-shadow-slight bg-white
                                        show-more-content-news d-block zoom-container zoom photos h-100 position-relative gray-border overflow-visible ">
                                        <div class="full-hd-container overflow-hidden image-holder" style="background-image: url('{{asset('uploads/gallery/'.$photo->filename)}}');"> 
                                            <img class="image" src="{{asset('uploads/gallery/'.$photo->filename)}}" alt="">
                                            <div class="dark-overlay "></div>
                                        </div>
                                        <div class="calendar-pad position-absolute p-1" style="transform: translate(3x,-3x)"> 
                                            <div class="date-day text-center">{!! date('j', strtotime($photo->created_at)) !!}</div>
                                            <div class="date-month text-center">{!! date('M y', strtotime($photo->created_at)) !!}</div>
                                        </div>                                                
                                        <div class="p-3   bg-white position-relative z-index-2 pb-3"> 
                                            <h6 class=""> 
                                                <span class="hover-underline title-caption" data-title="{{$photo->content}}"> 
                                                    {!! str_limit($photo->content, 120) !!} 
                                                </span>
                                            </h6>
                                        </div>
                                    </a>                    
                                </div>
                            @empty
                                <div class="col-12 p-3 text-muted">
                                    {{ label('lbl_no_information') }}
                                </div>
                            @endforelse
                        </div>
                    </div>
											
				</div>
  
			</div>
			
		</div>
		
	</div>
</div>

@endsection

@section('js-content')
 <script> 
       $(document).ready(function() {
          // $('.photo').each(function() {
              $(".photos").magnificPopup({
                  type: 'image',
                  delegate: '.media-container',
                  gallery: {
                      enabled: true
                  },
                   image: {
                    titleSrc: function(item) {
                        return item.el.find('.title-caption').attr('data-title');
                    }
                  }
              });
          // })

          $( ".media-container" ).click(function() {
             this.firstElementChild.click();
          });

          $( ".image-details" ).click(function() {
             
             event.stopImmediatePropagation();
             this.parentElement.click();
          });
      });
  </script>
@endsection
