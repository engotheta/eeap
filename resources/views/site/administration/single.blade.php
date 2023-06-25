@extends('site.layout')
@section('title')
@if(curlang() == '_sw')
{{ label('lbl_management')}}
@else
{{ label('lbl_management')}}
@endif
@endsection

@section('content')
<?php $local=""; ?>
<section class="main-content mb-2">
    <nav aria-label="breadcrumb" class="breadcrumb-container">
        <div class="container">
            <ol class="breadcrumb  py-1 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item active text-capitalize" aria-current="page">{!! label('lbl_biography') !!}</li>
            </ol>
        </div>
    </nav>
    <div class="content-border">

        
      @include('site.includes.left-sidebar')
      


      <div class="sub-main-content js-sub-main-height">
        <div class="row">
            <div class="col-md-12">
                <div class="biography">
                    <h4 class="title-decoration py-2 mb-3"> {!! label('lbl_biography') !!}</h4>
                    @if ($administration)
                    <div class="media"> 
                        <div class="card text-center p-2">
                            <div class="card-body p-1">
                                <img class="card-img-top mb-3" src="{{  url('/uploads/administration/medium-'.$administration->photo_url) }}" alt="{!! $administration->fullname !!}">
                                <h6 class="card-title mb-1">{!! $administration->title !!}</h6>
                                <h6 class="card-title mb-1">{!! $administration->fullname !!}</h6>
                            </div>
                        </div>
                        <div class="media-body">
                            {!! $administration->content !!}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!--/sub-main-content -->

</section>

@endsection

