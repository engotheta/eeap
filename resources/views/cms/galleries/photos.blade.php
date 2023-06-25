@extends('cms.application')
@section('content')


  	<!-- [ breadcrumb ] start -->
  	<div class="page-header">
  			<div class="page-block">
  					<div class="row align-items-center">
  							<div class="col-md-7">
  									<div class="page-header-title">
  											<h5 class="m-b-10">Galleries</h5>
  									</div>
  									<ul class="breadcrumb">
  											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
  											<li class="breadcrumb-item"><a href="javascript:">Site Contents</a></li>
  											<li class="breadcrumb-item"><a href="javascript:">Photo Galleries</a></li>
  									</ul>
  							</div>

  							<div class="col-md-5 text-right">
  									<a href="#" data-toggle="modal" data-target="#newGallery" class="btn btn-primary">
  										<i class="feather icon-image"></i> New Gallary
  									</a>
  							</div>
  					</div>
  			</div>
  	</div>
  	<!-- [ breadcrumb ] end -->

  	<!-- [ Main Content ] start -->
  	<div class="main-body">
  			<div class="page-wrapper">
  				<div class="row">

            @if($galleries->count() == 0)

              <div class="col-md-12">
                <div class="alert alert-primary" role="alert">{{ label('lbl_no_information') }}	</div>
              </div>
            @else

      					<div class="col-md-12">
      						<div class="card">
      							<div class="card-header text-capitalize" > <h5> Photo Galleries</h5></div>
      							<div class="card-body">
                      <div class="row grid">

                          @foreach($galleries as $key => $gallery)

                            <figure class="effect-kira">
                                <h6>{{ $gallery->title }}</h6>
                                    @if (count($gallery->photos) > 1)
                                      <img loading="lazy" src="{{ asset($gallery->photos->first()->image())}}" class="w-100">
                                      @else
                                        <img loading="lazy" src="{{ asset('admin/images/1.jpg')}}" class="w-100">
                                    @endif
                              <figcaption>
                              <h2>
                                      {{ number_format(count($gallery->photos))}} <i class="feather icon-image"></i>
                                </h2>
                                <p>
                                  <a href="{{ URL::route('cms.media.index', $gallery->id) }}">
                                    <i class="feather icon-eye"></i>
                                  </a>

                                  <a href="#" data-toggle="modal" data-target="#mediaTransfer{{ $gallery->id }}">
                                    <i class="feather icon-share-2"></i>
                                  </a>

                                  <a href="#" data-toggle="modal" data-target="#OpenModelContainer{{ $gallery->id }}">
                                    <i class="feather icon-edit"></i>
                                  </a>

                                  <a  href="{{ URL::route('cms.galleries.destroy', $gallery->id) }}" data-method ='delete'>
                                    <i class="feather icon-trash-2 text-danger"></i>
                                  </a>

                                  <a href="#">
                                    <i class="feather icon-download"></i>
                                  </a>
                                </p>

                              </figcaption>

                            </figure>

                            <div class="modal fade" id="OpenModelContainer{{ $gallery->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle"> Update {{ ucwords($gallery->type) }} </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                          {!! Form::model($gallery, ['route' => ['cms.galleries.update', $gallery->id], 'method' => 'PATCH']) !!}

                                            @include('cms.galleries._form', ['submitButton' => "Update"])

                                          {!! Form::close() !!}

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="mediaTransfer{{ $gallery->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle"> <b>Transfer All Content of {{ $gallery->title }} To Another Gallery</b> </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                              {!! Form::model($gallery, ['route' => ['cms.media.transfer-gallery', $gallery->id], 'method' => 'PATCH']) !!}

                                                @include('cms.media.transfer_form', ['submitButton' => "Update"])

                                              {!! Form::close() !!}

                                        </div>
                                    </div>
                                </div>
                            </div>

                          @endforeach
                      </div>

      							</div>
      						</div>

                  <div class="col-md-12">
                    {!!$galleries->render() !!}
                  </div>
      					</div>

            @endif

  				</div>
  			</div>
  	</div>


		<div class="modal fade" id="newGallery" tabindex="-1" role="dialog" aria-labelledby="newCategory" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
								<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLongTitle"> <b>New Gallery</b> </h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">×</span>
										</button>
								</div>
								<div class="modal-body">
                  {!! Form::open(['route' => 'cms.galleries.index']) !!}

          					@include('cms.galleries._form', ['submitButton' => "Save"])

          				{!! Form::close() !!}

								</div>
						</div>
				</div>
		</div>

@stop
