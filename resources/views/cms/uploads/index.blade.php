<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Browse Server</title>
	<link rel="stylesheet" href="{{ asset('admin/vendors/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{ asset('admin/vendors/fontawesome/css/all.min.css') }}">
	<style>
		body{
			overflow-x:hidden;
		}

		.bg-light-dark{
			background-color:rgba(238, 238, 238, 0.5);
		}

		.word-break{
			word-break: break-all;
		}

		.cursor-pointer{
			cursor: pointer;
		}

		.bold-600{
			font-weight: 600;
		}

		.fs-2rem{
			font-size:2rem;
		}

		.links-toggle{
			border-bottom: 2px solid #ccc;
			text-transform: uppercase;
		}

		.links-toggle a{
			border-radius: 0 !important;
		}

		.file-link:hover{
			color: rgb(18, 83, 156) !important;
			background-color:#ddd;
		}

	</style>
</head>
<body>
	<div class="container-fluid p-3">
		<div class="col-12 px-0 border bg-light-dark">
			<ul class="nav nav-pills nav-justified mb-3 bg-light links-toggle sticky-top" id="pills-tab" role="tablist">
				<li class="nav-item" role="presentation">
					<a class="nav-link active" id="pills-image-tab" data-toggle="pill" href="#pills-image" role="tab" aria-controls="pills-image" aria-selected="true">
						<h5 class="bold-600">GALLERY PHOTOS</h5>
					</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link" id="pills-image2-tab" data-toggle="pill" href="#pills-image2" role="tab" aria-controls="pills-image2" aria-selected="false">
						<h5 class="bold-600">UPLOADED PHOTOS</h5>
					</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link" id="pills-document-tab" data-toggle="pill" href="#pills-document" role="tab" aria-controls="pills-document" aria-selected="false">
						<h5 class="bold-600">UPLOADED FILES</h5>
					</a>
				</li>
			</ul>
		
			<div class="tab-content py-3" id="pills-tabContent">
		
				<div class="tab-pane fade show active" id="pills-image" role="tabpanel" aria-labelledby="pills-image-tab">
					<div class="row mx-0">
						@foreach($galleries as $gallery)
							@foreach ($gallery->photos as $m) 
								<div class="col-6 col-md-3 col-lg-2 py-2">
									<img loading="lazy" class="w-100 cursor-pointer" src="{{asset($m->image())}}" ondblclick="loadFile('{{asset($m->image())}}');">
								</div>
							@endforeach
						@endforeach
					</div>
				</div>
		
				<div class="tab-pane fade" id="pills-image2" role="tabpanel" aria-labelledby="pills-image2-tab">
					<div class="row mx-0">
						@foreach($uploaded_images as $image)
							<div class="col-6 col-md-3 col-lg-2 py-2">
								<img loading="lazy" class="w-100 cursor-pointer" src="{{$image['link']}}" ondblclick="loadFile('{{$image['link']}}');">
							</div>
						@endforeach
					</div>
				</div>
				
				<div class="tab-pane fade" id="pills-document" role="tabpanel" aria-labelledby="pills-document-tab">
					<div class="row mx-0">
						@foreach($uploaded_files as $file)
							<div class="col-12 col-md-6 py-2">
								<a class="h-100 bold-600 p-3 d-flex align-items-center cursor-pointer border file-link" ondblclick="loadFile('{{$file['link']}}');">
									<div class="px-2 mr-3 text-danger">
										<i class="fa fa-file-pdf fs-2rem"></i> 
									</div>
									<div class="">
										<div>{{$file['size']}}</div>
										<div class="word-break">{!! $file['name'] !!}</div>
									</div>
								</a>
							</div>
						@endforeach
					</div>
				</div>
		
			</div>
		</div>
	</div>
	
	<script src="{{ asset('admin/vendors/jquery/js/jquery.min.js') }}"></script>
	<script src="{{ asset('admin/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
	{{-- ck editor 4 --}}
    <script src="{{ asset('admin/vendors/ckeditor/ckeditor.js') }}"></script>
	<script>
		function loadFile(image_url){
			// console.log(image_url);
			window.opener.CKEDITOR.tools.callFunction({{$CKEditorFuncNum}}, image_url);
			window.close()
		}
	</script>

</body>
</html>