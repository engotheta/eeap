@extends('site.layout')
@section('title')

    {!! label('lbl_videos_gallery') !!}

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
                          <li class="breadcrumb-item active" aria-current="page">{!! label('lbl_vids') !!}</li>
                      </ol>
                    </nav>
                </div>
          </div>

          <div class="col-12 mt-3 main-content">
            <div class="row px-0 main-content-inside">

              <div class="col-12 what-we-do pb-3 video-one">
                    <div class="row">
                      <iframe class="embed-video" src="https://www.youtube.com/embed/{!! utube_hash($video->url) !!}"
                              allowfullscreen="allowfullscreen"  mozallowfullscreen="mozallowfullscreen"
                              msallowfullscreen="msallowfullscreen" oallowfullscreen="oallowfullscreen"
                              webkitallowfullscreen="webkitallowfullscreen" width="100%" height="450px"></iframe>
                    </div>

                    <div class="row pt-2">
                      <div class="col-md-4 video-poster">
                        <a href="{{ asset($video->path.$video->filename) }}"><img src="{{ asset($video->path.$video->filename) }}" alt="{{ $video->title}}"></a>
                      </div>
                      <div class="col-md-8 ">
                        <div class="col-12">
                          <h2>{{ $video->title}} </h2>
                          <h6 class="video-desc">{{ label('lbl_posted')}} {{ date('dS M Y',strtotime($video->created_at))}} </h6>
                        </div>

                        <div class="col-12">
                          <p>{{ $video->content_en }}</p>
                        </div>
                      </div>
                  </div>

              </div>

            </div>
          </div>
        </div>
        <!-- /main body -->
      </div>
    </div>

  </div>
@stop
