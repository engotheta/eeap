@extends('site.inner')
@section('title')
{!! $category->title !!}
@endsection


@section('breadcrumb')
<li class="breadcrumb-item @if(!$category->featured) active @endif" aria-current="page">{{ label('lbl_publications') }}</li>
@if($category->featured) <li class="breadcrumb-item active" aria-current="page">{{ label('lbl_licensing_requirements') }}</li> @endif
@endsection


{{-- @section('page_title')
{!! $category->title !!}
@endsection --}}

@section('page_content')
<div class="bg-gradient-white-light h-100 w-100 position-absolute top-left"></div>
<div class="about-page main-container container-fluid bg-white">
  <div class="col-12">
  
      <div class="row">
          <div class="col-lg-8 px-0 my-2 pr-lg-5 page-content">

              <div class="row mx-0 has-shifting-underline">

                <div class="col-12 py-1 px-0 ">
                  <h5 class="pb-2 position-relative page-title text-uppercase text-primary hover-text-primary"> 
                    <span class="d-inline-block py-2 position-relative text-bold text-primary">
                      <span class="px-2222"> {!! $category->title !!}</span>
                    </span>
                    <div class="d-flex w-100 position-absolute bottom-left">
                    <div class="shifting-underline-1 padding-1 bg-secondary"></div>
                    <div class="shifting-underline-2 padding-1 bg-primary"></div>
                    </div>
                  </h5>   
                </div>
      
                      
                @if (count($publications))

                  <div class="col-12 px-0 mt-2">
                    <div class="row">
                      @foreach ($publications as $key => $document)
          
                          {{-- <div class="col-lg-6 col-sm-6 col-12 mb-4">
                            <div class=" h-100  box-shadow-slight rounded-slight  overflow-hidden  bg-white ">
                              <a href="{!! asset('uploads/documents/'.$publication->file)!!}" target="_blank" class="has-hover-bounce p-2">
                                <div class="card-body image d-flex align-items-center">
                                  <h6 class="text-md border-left">
                                    <i class="fa fa-download hover-bounce"></i>
                                  </h6>
                                  <div class="ml-3">
                                    <h6 class="card-text text-muted">{!! date('d M, Y', strtotime($publication->published_date)) !!}</h6>
                                    <h6 class="card-text bold-600">{!! $publication->title !!}</h6>
                                  </div>
                                </div>
                              </a>
                            </div>
                          </div> --}}

                          <a target="_blank" href="{!! asset('uploads/documents/'.$document->file)!!}" class="col-12 d-flex p-0
                             h-100 mx-0 border-faded box-shadow-slight mb-2 cursor-pointer hover-bg has-hover-bounce has-hover-text-primary 
                             align-items-center has-hover-text-secondary rounded-slight">
                            <div class="padding-2 h-100 text-center borderrrr border-color-primary border-width-2">
                              <div class=" bg-primaryyy text-white h-100  d-flex justify-content-center position-relative align-items-center " >
                                <div class="p-2 round h-100 d-flex justify-content-center position-relative align-items-center boxss-40">
                                  <?php $file_path = (strpos($document->category->title, 'paper') !== false)  ? "site/images/svgs/form.svg":"site/images/svgs/document.svg" ?>
                                  <img src="{{asset($file_path)}}" class="hover-bounce black-icon position-relative z-index-2" style="width: 30px; height:auto">
                                </div> 
                              </div>
                            </div>
                            <div class="col p-2 h-100 d-flex flex-column justify-content-start"> 
                              <h6 class="card-text small text-muted">{!! date('d M, Y', strtotime($document->published_date)) !!}</h6>
                              <div class="hover-text-primary  text-left">{!! str_limit(strip_tags($document->title), 100) !!} </div>
                            </div>
                          </a>

                      @endforeach
                    </div>
                  </div>

                  <div class="col-12 pt-5 pb-3 d-flex justify-content-center">
                    {!! $publications->render() !!}
                  </div>

                @else
                  <div class="col-12 bold-600 px-0 py-3 text-muted">
                    {{label('lbl_no_information')}}
                  </div>
                @endif
                  
              </div>

          </div>
          <div class="col-lg-4 px-0 mt-2">
              @include('site.includes/sidebar')
          </div>
      </div>
      
  </div>

</div>

@stop
