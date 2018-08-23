
@extends ('layout.app_home')
<style>
	body {font-family: Arial, Helvetica, sans-serif;}

	#myImg {
	    border-radius: 5px;
	    cursor: pointer;
	    transition: 0.3s;
	}

	#myImg:hover {opacity: 0.7;}

	/* The Modal (background) */
	.modal {
	    display: none; /* Hidden by default */
	    position: fixed; /* Stay in place */
	    z-index: 1; /* Sit on top */
	    padding-top: 100px; /* Location of the box */
	    left: 0;
	    top: 0;
	    width: 100%; /* Full width */
	    height: 100%; /* Full height */
	    overflow: auto; /* Enable scroll if needed */
	    background-color: rgb(0,0,0); /* Fallback color */
	    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
	}

	/* Modal Content (image) */
	.modal-content {
	    margin: auto;
	    display: block;
	    width: 80%;
	    max-width: 700px;
	}

	/* Caption of Modal Image */
	#caption {
	    margin: auto;
	    display: block;
	    width: 80%;
	    max-width: 700px;
	    text-align: center;
	    color: #ccc;
	    padding: 10px 0;
	    height: 150px;
	}

	/* Add Animation */
	.modal-content, #caption {    
	    -webkit-animation-name: zoom;
	    -webkit-animation-duration: 0.6s;
	    animation-name: zoom;
	    animation-duration: 0.6s;
	}

	@-webkit-keyframes zoom {
	    from {-webkit-transform:scale(0)} 
	    to {-webkit-transform:scale(1)}
	}

	@keyframes zoom {
	    from {transform:scale(0)} 
	    to {transform:scale(1)}
	}

	/* The Close Button */
	.closes {
	    position: absolute;
	    top: 35px;
	    right: 35px;
	    color: white;
	    font-size: 50px;
	    font-weight: bold;
	    transition: 0.3s;
	}

	.closes:hover,
	.closes:focus {
	    color: gray;
	    text-decoration: none;
	    cursor: pointer;
	}

	/* 100% Image Width on Smaller Screens */
	@media only screen and (max-width: 700px){
	    .modal-content {
	        width: 100%;
	    }
	}
</style>
@section('content')

	<!-- Page Content -->
    <div class="container text-instead-box" id="page">

	    <!-- Page Heading/Breadcrumbs -->
	    <hr>
		<ol class="breadcrumb">
			<h4>Portofolio</h4>
		</ol>

	    <!-- The Modal -->
		<div id="myModal" class="modal">
			<span class="closes">&times;</span>
			<img class="modal-content" id="1">
			<div id="caption"></div>
		</div>

		<div class="row">

			@foreach ($resultPortofolio as $key => $value)

	            <div class="col-lg-4 portfolio-item">
				  <div class="card h-100">
				  	<div class="card-body">
				  	<h4 class="card-title">
				        <a href="#">{{ $value['portofolio_name'] }}</a>
				      </h4>
				    <!-- <a href="#"><img class="card-img-top" src="{{ url('assets/image/spect3000w.png') }}" alt=""></a> -->
				    <img id="myImg" src="{{ url('assets/portofolio_photo').'/'.$value['portofolio_photo'] }}" alt="" width="100%" height="400">
				    
				      
				      <p class="card-text">{{ $value['portofolio_description'] }}</p>
				    </div>
				  </div>
				</div>
	            
	        @endforeach

			
			<!-- <img id="myImg" src="{{ url('assets/image/logo.png') }}" alt="Trolltunga, Norway" width="300" height="200"> -->

		</div>
      <!-- /.row -->

    </div>
    <!-- /.container -->
    <div id="loading"></div>

@endsection

@section('js')
<script>

	function onReady(callback) {
	  	var intervalID = window.setInterval(checkReady, 1000);

  		function checkReady() {
		    if (document.getElementsByTagName('body')[0] !== undefined) {
		        window.clearInterval(intervalID);
		        callback.call(this);
		    }
	  	}
	}

	function show(id, value) {
	  document.getElementById(id).style.display = value ? 'block' : 'none';
	}

	onReady(function () {
	  show('page', true);
	  show('loading', false);
	});

	$(function() {
		$('.pop').on('click', function() {
			$('.imagepreview').attr('src', $(this).find('img').attr('src'));
			$('#imagemodal').modal('show');   
		});		
	});
</script>

@endsection
