@extends('site.layout')
@section('title')
 {{ label('lbl_deputies')}}
@endsection
@section('content')

  <div class="container  special-page">
          <div class="row">
            <div class="col-12 px-xs-0">
                  <nav aria-label="breadcrumb" class="mb-0">
                      <ol class="breadcrumb px-0">
                        <li class="breadcrumb-item "><a href="{{url('/')}}"><span class="fas fa-home"></span></a></li>
                        {!! breadcrumb() !!}
                      </ol>
                  </nav>
              </div>
          </div>

          <div class="col-md-12 bg-white py-3 page-content">
              <h4>{{ label('lbl_deputies') }}</h4>
              <div class="col-12 px-0 mt-4">


                <div class="row justify-content-start">

                  @foreach ($administrations as $key => $member)
                        <div class="col-xs-12 col-sm-6 col-md-3 text-center">
                          <div class="">
                            <img src="{{ asset('/uploads/administration/'.$member->photo_url) }}"
                              alt="{!! $member->salutation !!} {!! $member->fullname !!}" class="img-fluid w-75 administration-img-profile">
                          </div>
                          <div class="col-12 mt-2">
                            <a href="#" data-toggle="modal" data-target="{{'#administrationMinister'.$key}}">
                              <h6 class="">{!! $member->salutation !!} {!! $member->fullname !!}</h6>
                              <p class="mt-0"><b>{!! $member->title !!}</b></p>
                            </a>
                          </div>
                        </div>

                        <div class="modal fade" id="{{'administrationMinister'.$key}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width:85%">
                                <div class="modal-content letter">
                                    <div class="modal-header">
                                        <h5 class="modal-title" > {!! $member->title !!} </h5>
                                        <button type="button" class="close text-right btn" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">
                                              <img src="{{ asset('site/images/svgs/close.svg')}}" alt="" class="w-25">
                                            </span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                            <div class="row">
                                              <div class="col-md-4 col-xs-12">
                                                  <img src="{{ asset('/uploads/administration/'.$member->photo_url) }}"
                                                  alt="{!! $member->salutation !!} {!! $member->fullname !!}" class="img-fluid w-100 administration-img-profile">
                                              </div>

                                              <div class="col-md-8 col-xs-12">
                                                <div class="">
                                                  <h5 class="title mb-2"> {!! $member->salutation !!} {!! $member->fullname !!}</h5>
                                                </div>
                                                <div class="col-12 px-0 my-2">
                                                  {!! $member->content !!}
                                                </div>
                                              </div>
                                            </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                  @endforeach
                </div>



              </div>
          </div>
  </div>

@stop
