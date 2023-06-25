@extends('site.inner')

@section('title')
    {!! $page->title !!}
@endsection



@section('page_content')

@section('breadcrumb')
    {{ breadcrumb() }}
@endsection
<div class="">
    <div class="col-12">
        <div class="col-12 py-3">
            <div class="row">
                <div class=" @if($page->has_sidebar == 1) col-lg-8 @else col-lg-12 @endif page-content mb-2">
                    <div class="row pr-md-5 has-shifting-underline">
                        <div class="col-12 px-0 py-1">
                            <h5 class="pb-2 position-relative page-title text-uppercase text-primary hover-text-primary"> 
                                <span class="d-inline-block py-2 position-relative text-bold text-primary">
                                    <span class="px-2222">{!! $page->title !!}</span>
                                </span>
                                <div class="d-flex w-100 position-absolute bottom-left">
                                <div class="shifting-underline-1 padding-1 bg-secondary"></div>
                                <div class="shifting-underline-2 padding-1 bg-primary"></div>
                                </div>
                            </h5> 
                        </div>
                        <div class="col-12 px-0 mt-2">
                            <div class="rich-text py-2">
                                
                                <?php 
                                    $content = $page->content;
                                    // demo pages to shift to live with breaking image links
                                    //http://localhost/uploads/text-editor/images/organization_1654703666.png
                                    $local = 'http://localhost/uploads';
                                    $test = 'http://staging1.eganet.go.tz/utumishi/uploads';
                                    if(strpos($content, $local) !== false) $content = str_replace($local,asset('uploads'),$content);
                                    if(strpos($content, $test) !== false) $content = str_replace($test,asset('uploads'),$content);
                                ?>

                                {!! $content !!}
                            </div>
                        </div>
                    </div>
                </div>
                @if($page->has_sidebar == 1)
                <div class="col-lg-4 px-0">
                    @include('site.includes/sidebar')
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@stop
