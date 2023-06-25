@extends('site.layout')
@section('title')
 {{ label('lbl_former_pm')}}
@endsection


@section('content')

    <div class="col-12 container special-page">
          <nav aria-label="breadcrumb" class="mb-0">
              <ol class="breadcrumb px-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><span class="fas fa-home"></span></a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{ label('lbl_former_pm')}}</li>
              </ol>
          </nav>

          <div class="row">

              <div class="col-md-9 page-content bg-white pt-3">
                  <h4>{{ label('lbl_former_pm')}}</h4>
                  <div class="col-12 px-0 mt-4">


                      <div class="main-timeline3">

                          @if (count($administration))
                            @foreach ($administration as $key => $person)

                                  <div class="timeline">
                                      <div class="img-profile-2 timeline-profile">
                                          <img src="{{ asset('uploads/administration/'.$person->photo_url)}}" alt="">
                                      </div>
                                      <div class="timeline-icon">
                                          <span class="year"> {{ date('Y',strtotime($person->end_date))}} <br>
                                            <i class="far fa-arrow-alt-circle-up"></i><br>
                                            {{ date('Y',strtotime($person->start_date))}}
                                          </span>
                                      </div>
                                      <div class="timeline-content">
                                          <a href="{{ url('administration/profile/'.$person->id)}}">
                                              <h3 class="title">{{ $person->salutation}} {{ $person->fullname}}</h3>
                                              <p class="description">
                                                  {!! str_limit(strip_tags($person->content), 250) !!}
                                              </p>
                                          </a>
                                      </div>
                                  </div>
                            @endforeach
                          @endif



                      </div>

                  </div>
              </div>

              <div class="col-md-3 navigation-column">
                    @include('site.includes.sidebar')
              </div>
          </div>
      </div>

@stop
