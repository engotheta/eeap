@extends('site.inner')

@section('title')
  {!! $category->title !!}
@endsection

@section('breadcrumb')
    {{ breadcrumb() }}
@endsection

{{-- @section('page_title')
    {!! $category->title !!}
@endsection --}}

@section('page_content')

<div class="about-page main-container container-fluid  bg-white">
  <div class="col-12">

    <div class="row mx-0">
      <div class="col-lg-12 px-0 my-2 page-content">

        <div class="row mx-0 has-content-title">
          <div class="col-12 px-0 py-1 ">
            <h5 class="text-left content-title py-4 mb-4 font-20">{!! $category->title !!}</h5>
           
          </div>
          <div class="col-12 px-0">
            <div class="pb-3 rich-text w-100">
              {!! nl2br($category->summary) !!}
            </div>
            <div class="col-12 px-0">

              @if(count($members))
                  @foreach ($members as $group)

                    <div class="row mx-0 my-3 justify-content-center border-bottom">
                      @foreach ($group as $member)
                        
                        <div class="col-12 col-sm-6 col-md-3 text-center py-3">
                            <a href="{!! url('administration/'.$category->slug.'/'.$member->member->slug) !!}" title="{{ label('lbl_view').' '.label('lbl_biography') }}" class="d-block w-100 borderr members-link-hover"> 
                            <div class="d-block bg-light pt-3" style="width:240px">
                                 <div class="text-center pb-3">
                                  <img src="{{asset('uploads/administration/'.$member->member->photo_url)}}" alt="{{$member->member->fullname.' photo'}}"
                                    class="img-fluid round" style="width:100%; max-width:200px">
                                </div>                
                                <div class="py-2 border-top border-color-white bg-primary">
                                  <h6 class="text-bold text-white">{!! $member->member->salutation.' '.$member->member->fullname !!}</h6> 
                                  <p class="text-white faded mb-1 bold-600">{!! $member->title !!}</p>
                                </div>     
                            </div>
                                            
                            </a>
                        </div>

                      @endforeach
                    </div>

                  @endforeach
              @else
                <div class="col-12 px-0 py-3 bold-600">
                  {{label('lbl_no_information')}}
                </div>
              @endif

            </div>
          </div>          
        </div>

      </div>
      
    </div>
    
  </div>
</div>

@stop