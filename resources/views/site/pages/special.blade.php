@extends('site.layout')
@section('title')
	@if(curlang() == '_sw')
	{!! $page->title !!}
	@else
	{!! $page->title !!}
	@endif
@endsection

@section('css-content')
	<style media="screen">
		 .vertical-list li{
			     border-top: 1px solid #b5b5b5;
			     border-bottom: 1px solid #b5b5b5;
		 }
	</style>
@stop

@section('content')
<div class="col-12 px-xs-0">
    <nav aria-label="breadcrumb" class="mb-0">
        <ol class="breadcrumb px-0">
                                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><span class="fas fa-home"></span></a></li>

            <li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
        </ol>
    </nav>
</div>


    <div class="container px-0">
        <div class="col-12 special-page">
            <div class="col-12 p-4">
                <div class="row">
                   
                </div>

                <div class="row bg-white ">

										<div class="col-md-3">
											<ul class="list-inline mx-auto vertical-list mt-4">	{!! App\Models\MenuItem::getMenu($page->slug) !!}	</ul>
										</div>
                    <div class="col-md-9 py-3 page-content">
                        <h4>{{ $page->title }}</h4>
                        <div class="col-12 px-0 mt-4">

                            @if($page)
                                {!! $page->content !!}
                            @else
                                {!! label('lbl_no_information') !!}
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

@stop
