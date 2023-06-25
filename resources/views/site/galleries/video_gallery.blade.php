@extends('site.inner')

@section('title')
    {!! $album->title !!}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{url('galleries/listing/videos')}}">{{label('lbl_videos_gallery')}}</a></li>
<li class="breadcrumb-item active" aria-current="page"> {!! str_limit(strip_tags($album->title) , 25) !!}  </li>
@endsection

{{-- @section('page_title')
{!! $album->title  !!}
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
                          <span class="px-2222"> {!! $album->title !!} </span>
                        </span>
                        <div class="d-flex w-100 position-absolute bottom-left">
                        <div class="shifting-underline-1 padding-1 bg-secondary"></div>
                        <div class="shifting-underline-2 padding-1 bg-primary"></div>
                        </div>
                    </h5>
                </div>
  
				<div class="row mx-0">
					
                    <div class="col-12 px-0 d-block mt-4 border-bottom-faded border-color-secondary">
                        <div class="rich-text pb-3">
                            {!! $album->content !!}
                        </div>
                    </div>
                    <div class="col-12 px-0 pt-3">
                        <div class="row gray-border mb-3 photos">
                            @forelse($videos as $key => $video)
                                <div class="col-md-3 media-thumbnail p-2 ">
                                    <a target="_blank" rel="noopener noreferrer" href="{{$video->url}}" 
                                        class="popup-youtube position-relative gray-border border d-block w-100  h-100
                                        box-shadow-slight bg-white zoom-container pointer-hover show-more-content-news">
                                        <div class="full-hd-container position-relative" style="background-image: url('{{ youtube_thumbnail($video->url) }}');"> 
                                            <div class="position-absolute image h-100 w-100 background-image top-left" 
                                               style="background-image: url('{{ youtube_thumbnail($video->url) }}');">
                                            </div>
                                            <div class="dark-overlay "></div>
                                            <div class="position-absolute d-flex align-items-center justify-content-center
                                                image h-100 w-100 background-image top-left">
                                                <div class="play-bg d-flex align-items-center justify-content-center bg-primary position-absolute ">
                                                    <i class="fa fa-expand"></i>
                                                    <i class="fa fa-play"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-3 pb-3"> 
                                        <h6 class=""><span class="hover-underline"> {!! str_limit($video->title, 50) !!} </span></h6>            
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
            /* Video - Magnific Popup */
            $('.popup-youtube, .popup-vimeo').magnificPopup({
                disableOn: 700,
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false,
                iframe: {
                    patterns: {
                        youtube: {
                            index: 'youtube.com/',
                            id: function(url) {
                                var m = url.match(/[\\?\\&]v=([^\\?\\&]+)/);
                                if ( !m || !m[1] ) return null;
                                return m[1];
                            },
                            src: 'https://www.youtube.com/embed/%id%?autoplay=1'
                        },
                        vimeo: {
                            index: 'vimeo.com/',
                            id: function(url) {
                                var m = url.match(/(https?:\/\/)?(www.)?(player.)?vimeo.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/);
                                if ( !m || !m[5] ) return null;
                                return m[5];
                            },
                            src: 'https://player.vimeo.com/video/%id%?autoplay=1'
                        }
                    }
                }
            });

        });
    </script>
@stop

