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
                <div class=" @if($page->has_sidebar == 1)  col-lg-8 @else col-lg-12 @endif page-content mb-2">
                    <div class="row pr-md-5 has-content-title">
                        <div class="col-12 px-0 py-1">
                            <h5 class="text-left content-title py-4 mb-4 font-20">{!! $page->title !!}</h5>
                        </div>
                        <div class="col-12 px-0 mt-2">
                            <div class="rich-text py-2">
                                
                                <?php 
                                    $content = $page->content;
                                    // demo pages to shift to live with breaking image links
                                    //http://localhost/uploads/text-editor/images/organization_1654703666.png
                                    $local = 'http://localhost/uploads';
                                    $test = 'http://test.org/site/uploads';
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
