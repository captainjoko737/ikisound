@extends ('layout.app_home')

@section('content')

	<!-- Page Content -->
    <div class="container text-instead-box" id="page">

      <hr>
      <ol class="breadcrumb">
        <h4>Package</h4>
      </ol>

      <!-- Project One -->
      <div class="row">

        @foreach ($resultPackage as $key => $value)
            
          <div class="col-md-7">
            <a href="#">
              <img class="img-fluid rounded mb-3 mb-md-0" src="{{ url('public/assets/package_photo').'/'.$value['package_photo'] }}" width="100%" height="25%" alt="">
            </a>
            <hr>
          </div>
          <div class="col-md-5">
            <h3>{{ $value['package_name'] }}</h3>
            <p>{{ $value['package_description'] }}</p>
            <!-- <h4>Spect Price</h4> -->
          </div>

        @endforeach
        
      </div>
      <!-- /.row -->
      <hr>
    </div>
    <!-- /.container -->
    <div id="loading"></div>

@endsection

@section('js')
  
<script type="text/javascript">
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
</script>
@endsection
