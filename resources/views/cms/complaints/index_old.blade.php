@extends('cms.application')
@section('content')
@section("stylesheets")
<style>
.complains{
	margin: 0;
	padding: 0;
	list-style: none;
}

.complains li{
	border-bottom: 1px solid #ddd;
    padding: 8px 10px;
}

.complains li.selected{
	background: #4aa3df;
}

.complains li.selected a span.subject,
.complains li.selected a span.sender{
	color: #fff;
}

.complains li a{
	color: #444;
}

.complains li a span.subject{
	font-family: "HelveticaNeue";
}

.complains li a span.sender{
	font-family: "HelveticaNeue-Light";
	font-size: 14px;
}

.complaint-single{

}


.boldit{
	font-weight: bold;
}

.empty-complain{
	font-size: 36px;
	line-height: 500px;
	font-family: "HelveticaNeue-UltraLight";
	margin: auto;
	text-align: center;
	color: #999;
}

.subject{
	font-family: "HelveticaNeue-Bold";
	font-size: 14px;
}

span.email,
span.date,
span.fullname,
span.phone{
	font-family: "HelveticaNeue-Light";
	font-size: 14px;
}

.message{
	font-family: "HelveticaNeue-Light";
	color: #000;
	font-size: 16px;
}
</style>
@stop

<div class="row ">
	<div class="large-12 medium-12 small-12 columns">

		<div class="content-panel">

			<div class="title">
		        Complains
		    </div>

		</div>
	</div>
</div>


<div class="row ">
	<div class="large-4 medium-4 small-12 columns">

		<div class="content-panel">

		    <div class="content remove-padding content-large">

				<ul class="complains">
					@foreach($complains as $comp)
					  <li>
						  <a href="{{ URL::route('cms.complains.show', $comp->id) }}">
						  <span class="subject {{ $comp->read == 0 ? 'boldit' : '' }}">
							  {{ substr($comp->subject, 0, 120) }}
						  </span><br />
						  <span class="sender">{{ $comp->email }}</span>
						  </a>
					  </li>
					@endforeach
				</ul>

				{!! $complains->render() !!}

		    </div>

		</div>

	</div>


	<div class="large-8 medium-4 small-12 columns">
		<div class="content-panel">
			<div class="content content-large">
				<div class="complaint-single">
						<p class="empty-complain">Select a Complaint to Preview</p>
				</div>
			</div>
		</div>
	</div>

</div>

@stop

@section('scripts')
	<script>
	  $(document).ready(function(){
	  	$(".complains li a").click(function(e){
	  		e.preventDefault();

	  		$('ul.complains li').removeClass('selected');
	  		console.log($(this).parent());

            $($(this).parent()).addClass('selected');

	  		var loader = "<div id='loader'><span><i class='ion ion-load-a spin'></i></span></div>";

	  		$(".empty-complain").html(loader);

	  		$.get($(this).attr('href'), function(data) {
			  $(".complaint-single").html(data);
			})
			.fail(function() {
			    console.log( "error" );
		 	})
		 	.always(function(){
		 		$(".loader").hide();
		 	});


	  	});
	  });
	</script>
@stop
