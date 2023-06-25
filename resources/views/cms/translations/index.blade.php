@extends('cms.application')

@section('content')

  <!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-6">
									<div class="page-header-title">
											<h5 class="m-b-10">Translation</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">Settings</a></li>
											<li class="breadcrumb-item"><a href="javascript:">Translation</a></li>
									</ul>
							</div>

{{--              <div class="col-md-6 text-right">--}}
{{--                <a class="btn btn-primary" href="{!! URL::route('cms.translations.create') !!}">Add New</a>--}}
{{--              </div>--}}
					</div>
			</div>
	</div>
	<!-- [ breadcrumb ] end -->

	<!-- [ Main Content ] start -->
	<div class="main-body">
			<div class="page-wrapper">
				<div class="row">

					<div class="col-md-12">
						<div class="card">
							<div class="card-header" > <h5>List Of Translation</h5></div>
							<div class="card-body">
								@if(count($translations))
                  {!! Form::open(array('route' => 'cms.translations.update', 'method' => 'POST')) !!}
                  <div class="row justify-content-end">
                    {!! Form::submit('Save Changes', array('class' => 'btn btn-info')) !!}
                    {{-- <a class="btn btn-primary" href="{!! URL::route('cms.translations.create') !!}">Add New</a> --}}
                  </div>
                  <table class="table table-hover table-striped dataTable" style="width:100%">

                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Keysword</th>
                        <th>En</th>
                        <th>Sw</th>
                      </tr>
                    </thead>

                    <tbody>

                      @foreach($translations as $key => $value)
                        <tr>
                          <td>{!! $key +1 !!}</td>
                          @php  $id = $value['id']; $keyword = $value['keyword']  @endphp
                          {!! deleteUnusedFields(array('id','created_at','updated_at','flag','slug','user_id','keyword'),$value) !!}
                          <td>
                            @if(Request::get('aa')=='wrath')
                              {!! link_to_route('cms.translations.destroy', "", array($id,'aa'=>Request::get('aa')), array('data-method' => 'delete', 'data-confirm' => 'Are you Sure' ,'class' => 'ion ion-android-delete item-delete')) !!}
                            @endif
                            {!!$keyword!!}
                            <span style="display:none;">{!!$keyword!!}</span>
                          </td>
                          @foreach($value as $name=>$val)
                            <td>
                              {!! Form::text("keyword[$id][$name]", $val ,['class'=>'form-control']) !!}
                              <span style="display:none;">{!!$val!!}</span>
                            </td>
                          @endforeach
                        </tr>

                      @endforeach
                    </tbody>

                  </table>
                  {!! Form::close() !!}
                @else
									<div class="col-md-12">
										<div class="alert alert-primary" role="alert">
                      <h4>No any translation posted yet please! click the button below to create one </h4>
                      <a class="btn btn-primary" href="{!! URL::route('cms.translations.create') !!}">Add New</a>
                    </div>
									</div>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
	<!-- [ Main Content ] end -->

@stop
