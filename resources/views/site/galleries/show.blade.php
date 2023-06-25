@extends('site.layout')
@section('title')

        {!! label('lbl_events') !!}

@endsection

@section('content')
<?php $local=$currentLanguage->locale; ?> 
<div class="main-content-wrapper">
    <div class="gallery-main-content-wrapper div-match-height-slider-bio">
        <div class="main-content div-match-height">
            <h1 class="title-decoration"> {!! label('lbl_photo_gallery') !!} </h1>
            <ul class="gallery-listing">

                <div class="popup-gallery">
                        @foreach($gallery as $photos)
                        <a href="{!! asset('uploads/gallery/'.$photos->filename) !!}" class="gallery-item" title="{!! $photos->content !!}">
                        <img src="{!! asset('uploads/gallery/'.$photos->filename) !!}" width="260" height="180">
                        </a>
                        @endforeach                         
                    </div>

                
                </ul>
            <nav class="text-center">
                <ul class="pagination">
                  {!!  $galleries->render() !!}
                </ul>
            </nav>
            <!-- /.gallery-listing -->
        </div>

        
    </div>
</div>
@stop