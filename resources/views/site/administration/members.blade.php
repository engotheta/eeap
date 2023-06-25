@extends('site.inner')

@section('title')
  {{ label('lbl_administration') }}
@endsection

@section('breadcrumb')
    {{ breadcrumb() }}
@endsection

@section('page_title')
    {!! label('lbl_administration') !!}
@endsection

@section('page_content')

<div class="members-page main-container container bg-white">

    <div class="row">
        <div class="col-lg-8 page-content my-2">

            <div class="pr-md-5">
                <div class="col-12 px-0 mt-2">
                    @if(count($members))

                      <div class="table-responsive">
                          <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">{{ label('lbl_name') }}</th>
                                  <th scope="col">{{ label('lbl_desc') }}</th>
                                  <th scope="col">{{ label('lbl_biography') }}</th>
                                </tr>
                              </thead>
                              <tbody>

                                @foreach($members as $member)  
                                  <tr>
                                    <th class="align-middle" scope="row">
                                        <img src="{{asset('uploads/administration/'.$member->photo_url)}}" alt="{{$member->fullname.' photo'}}" 
                                        style="width: 70px; max-height: 75px;">
                                    </th>
                                    <td class="align-middle">{{ $member->salutation.' '.$member->fullname }}</td>
                                    <td class="align-middle">{{ $member->title }}</td>
                                    <td class="align-middle"><a href="{!! url('administration/members/'.$member->slug) !!}"><u>{{ label('lbl_biography') }}</u></a></td>
                                  </tr>
                                @endforeach
                                
                              </tbody>
                          </table>
                      </div>

                      <div class="mt-5 d-flex justify-content-center">
                        {!! $members->render() !!}
                      </div>

                    @else

                      <div class="col-12 px-0">
                        {{label('lbl_no_information')}}
                      </div>

                    @endif

                </div>
                
            </div>

        </div>
        <div class="col-lg-4 px-3">
          {{-- include the sidebar --}}
          @include('site.includes/sidebar')
        </div>
    </div>


</div>


@stop

