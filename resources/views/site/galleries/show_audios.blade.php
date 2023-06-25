@extends('site.layout')
@section('title')

    {!! label('lbl_audios_gallery') !!}

@endsection

@section('content')

  <div class="col-12 px-0">
    <div class="home-page col-12 px-0">
      <div class="row px-0">

        <!-- main body -->
        <div class="col-12 mt-xs-0 px-xs-0">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb" class="mb-0">
                      <ol class="breadcrumb px-1">
                          <li class="breadcrumb-item"><a href="{{ url('/')}}"><span class="fas fa-home"></span></a></li>
                          <li class="breadcrumb-item active" aria-current="page">{!! label('lbl_audios_gallery') !!}</li>
                          <li class="breadcrumb-item active" aria-current="page">{{ $album->title}}</li>
                      </ol>
                    </nav>
                </div>
          </div>

          <div class="col-12 mt-3 main-content">
            <div class="row px-0 main-content-inside">

              <div class="col-12 what-we-do mt-3 py-3">
                <div class="row mb-4">
                  <div class="col-md-12">
                    <h5 class="my-2 text-left text-xs-left section-header">{{ $album->title}}</h5>
                    <div class="row mt-4 pl-xs-3 ">
                    @empty ($audios)
                          <div class="col-12">
                            {!! label('lbl_no_information') !!}
                          </div>
                        @else
                          @foreach($audios as $audio)
                            <div class="col-md-4 mx-1">
                                <div class="slide-video">
                                  <img src="{{ asset($audio->path.$audio->filename) }}" alt="{!! $audio->title_en !!}">
                                  <audio src="{{ asset($audio->path.$audio->url) }}" controls class="w-100"> </audio>
                                </div>
                              </div>
                          @endforeach
                        @endempty

                    </div>
                  </div>

                </div>

                <div class="row mb-2">
                    <div class="col-md-12">
                        <ul class="pagination justify-content-center d-flex">
                            {!!  $audios->render()!!}
                          </ul>
                    </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <!-- /main body -->
      </div>
      <div class="col-12">
        <img src="{{ asset('site/images/bg/g4.png')}}" class="w-100" style="transform:rotate(180deg)">
      </div>
    </div>

  </div>



                          {{-- @if(count($audios))
                              @foreach($videos as $video)

      	                        <div class="row border-bottom my-2">
      	                            <div class="col-md-4">
      	                                <div class="video-container mb-2">
                                          <iframe src="https://www.youtube.com/embed/{!! utube_hash($video->url) !!}"
                                                  allowfullscreen="allowfullscreen"
                                                  mozallowfullscreen="mozallowfullscreen"
                                                  msallowfullscreen="msallowfullscreen"
                                                  oallowfullscreen="oallowfullscreen"
                                                  webkitallowfullscreen="webkitallowfullscreen"></iframe>    	                                </div>
      	                            </div>
      	                            <div class="col-md-8">
      	                                <div class="">
                                          @if(curlang() == '_en')
                                              <h6 class="mb-1">{!! $video->title_en !!}</h6>
                                              <p class="mb-1">{!! $video->content_en !!}</p>
                                          @else
                                              <h6 class="mb-1">{!! $video->title_sw !!}</h6>
                                              <p class="mb-1">{!! $video->content_sw !!}</p>
                                          @endif
      	                                    <p class="text-muted">{{ label('lbl_posted')}} : <i class="fas fa-calendar-alt"></i> </p> --}}


@stop
