@extends('cms.application')
@section('content')

	<!-- [ breadcrumb ] start -->
	<div class="page-header">
			<div class="page-block">
					<div class="row align-items-center">
							<div class="col-md-12">
									<div class="page-header-title">
											<h5 class="m-b-10">Administration Categories</h5>
									</div>
									<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{ url('/cms') }}"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="javascript:">User Administration</a></li>
											<li class="breadcrumb-item"><a href="{{ url('/cms/administration_categories') }}">Administration Categories</a></li>
											<li class="breadcrumb-item"><a href="javascript:">{{$category->title}}</a></li>
									</ul>
							</div>
					</div>
			</div>
	</div>
	<!-- [ breadcrumb ] end -->

	<!-- [ Main Content ] start -->
	<div class="main-body">
			<div class="page-wrapper">

				<div class="card-block mb-4">
					<div class="col-md-12">
						<div class="row">
							<h5 class="d-inline">{{$category->title}}</h5>
						</div>
						<div class="row">
							<div class="col-md-5">
								<select class="form-control select2"  multiple="multiple" id="gridMember">
									@foreach ($members as $key => $member)
										<option value="{{$member}}">{{$member->salutation}} {{$member->fullname}}</option>
									@endforeach
								</select>
							</div>

							<div class="col-md-1">
								<h3><i class="feather icon-plus-square add-grid-member"></i></h3>
							</div>

							<div class="col-md-5">
								{{-- <select class="form-control select2"  multiple="multiple" id="addedGridText">
									@foreach ($translations as $key => $word)
										<option value="{{$word->keyword}}">{{$word->en}} : {{$word->sw}}</option>
									@endforeach
								</select> --}}
								<input class="form-control" id="addedGridText" data-role="tagsinput" placeholder="Add Text Block">
							</div>

							<div class="col-md-1">
								<h3><i class="feather icon-plus-square add-grid-text"></i></h3>
							</div>
						</div>
					</div>

					<div class="clearfix"></div>
					<hr>
					<div class="row">
						<div class="col-sm-12">
							<div class="trash"> </div>
						</div>
					</div>
					<hr>

						<div id="grid-to-save" class="grid-stack" data-gs-width="20" data-gs-animate="yes">	</div>
				</div>

			</div>
	</div>
	<!-- [ Main Content ] end -->
@stop

@section('scripts')
	<script type="text/javascript">

	var grid = GridStack.init({
			float: true,
			removable: '.trash',
			removeTimeout: 5,
			resizable: {
        handles: 'e, se, s, sw, w'
      },
			acceptWidgets: '.grid-stack-item'
		});

		// add content if exist from db
		@if ($category->content != null)
		grid.removeAll();
			var items = GridStack.Utils.sort({!! $category->content !!});
			grid.batchUpdate();
			items.forEach(function (node) {

				if (node['type'] == 'member') {

					grid.addWidget('<div data-gs-type="member"'+
															'data-gs-member-slug="'+node['slug']+'"'+
															'data-gs-member-salutation-sw="'+node['salutation_sw']+'"'+
															'data-gs-member-salutation-en="'+node['salutation_en']+'"'+
															'data-gs-name="'+node['name']+'"'+
															'data-gs-id="'+node['id']+'"'+
															'data-gs-image="'+node['image']+'">'+
								'<div class=" grid-stack-item-content row d-flex px-3 justify-content-center text-center my-3">'+
									'<div class="col-12"><img loading="lazy" src="'+window.ajaxBasePath+'/uploads/administration/'+node['image']+'" class="w-100"/></div>'+
									'<div class="col-12"><h6 class="w-100 ">'+node['name']+'</h6></div>'+
								'<div/>'+
						'</div>', {x:node['x'], y:node['y'], width: node['width'], height:node['height']});
				} else {

					grid.addWidget('<div data-gs-type="title"'+
															'data-gs-name="'+node['name']+'">'+
							'<div class="grid-stack-item-content" >'+node['name']+'</div></div>', {x:node['x'], y:node['y'], width: node['width'], height:node['height']});

				}
			});
			grid.commit();
		@endif

		// add new administration member
		$('.add-grid-member').on('click', function(){
			var r = $('#gridMember').val();

			for (var i = 0; i < r.length; i++) {
				var keyword = JSON.parse(r[i]);

				grid.addWidget('<div data-gs-type="member"'+
														'data-gs-member-slug="'+keyword['slug']+'"'+
														'data-gs-member-salutation-sw="'+keyword['salutation_sw']+'"'+
														'data-gs-member-salutation-en="'+keyword['salutation_en']+'"'+
														'data-gs-id="'+keyword['id']+'"'+
														'data-gs-name="'+keyword['fullname']+'"'+
														'data-gs-image="'+keyword['photo_url']+'">'+
							'<div class="grid-stack-item-content row d-flex px-3 justify-content-center text-center my-3">'+
								'<div class="col-12"><img loading="lazy" src="'+window.ajaxBasePath+'/uploads/administration/'+keyword['photo_url']+'" class="w-75"/></div>'+
								'<div class="col-12"><h6 class="w-100 ">'+keyword['fullname']+'</h6></div>'+
							'<div/>'+
					'</div>', {width:3, height:3});
			}
		});

		// add new administration title
		$('.add-grid-text').on('click', function(){
			var r = $('#addedGridText').val().split(',');
			for (var i = 0; i < r.length; i++) {
				var keyword = r[i];
				grid.addWidget('<div data-gs-type="title" data-gs-name="'+keyword+'">'+
						'<div class="grid-stack-item-content">'+keyword+'</div></div>', {width:3, height:1});
			}
		});

		grid.on('added', function(event, items) {
			saveGrid()
		});

		grid.on('change', function(event, items) {
			saveGrid()
		});

		grid.on('removed', function(event, items) {
			saveGrid()
		});

		function saveGrid(){
			var serializedData = [];
			$('.grid-stack-item').each(function () {
        var $this = $(this);

        serializedData.push({
            x: $this.attr('data-gs-x'),
            y: $this.attr('data-gs-y'),
            width: $this.attr('data-gs-width'),
            height: $this.attr('data-gs-height'),
            id: $this.attr('data-gs-id'),
            type: $this.attr('data-gs-type'),
						slug: $this.attr('data-gs-member-slug'),
						salutation_sw: $this.attr('data-gs-member-salutation-sw'),
						salutation_en: $this.attr('data-gs-member-salutation-en'),
						image: $this.attr('data-gs-image'),
						name: $this.attr('data-gs-name'),
        });
    });

			var data = JSON.stringify(serializedData);

			console.log(data);

			$.ajax({
					 url:'{{ url('/cms/administration_categories/'.$category->id)}}',
					 type: "POST",
					 data: {content: data, _method: 'PATCH', _token:window.csrfToken},
					 dataType: 'json',
					 success: function(data){
						 new PNotify({
										 title: 'Done',
										 text: 'Administration Members Updated Succussfull.',
										 type: 'success'
								 });
					 },
					 error: function(data){

						 new PNotify({
										 title: 'Operation Failed',
										 text: 'Something Went Wrong.',
										 type: 'error'
								 });
					 },

			 });
		}

</script>
@stop
