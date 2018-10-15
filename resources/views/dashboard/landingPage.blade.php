@extends ('layout.app_home')

@section('content')

    <div id="page" class="text-instead-box">

      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active" style="background-image: url('public/assets/image/header.jpg')">
            <div class="carousel-caption d-none d-md-block">
              <!-- <h3>First Slide</h3>
              <p>This is a description for the first slide.</p> -->
            </div>
          </div>
          <!-- Slide Two - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('public/assets/image/header.jpg')">
            <div class="carousel-caption d-none d-md-block">
             <!--  <h3>Second Slide</h3>
              <p>This is a description for the second slide.</p> -->
            </div>
          </div>
          <!-- Slide Three - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('public/assets/image/header.jpg')">
            <div class="carousel-caption d-none d-md-block">
              <!-- <h3>Third Slide</h3>
              <p>This is a description for the third slide.</p> -->
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

      <!-- Page Content -->
      <div class="container">

        <ol class="breadcrumb">
          <h4>Package</h4>
        </ol>

        <!-- Marketing Icons Section -->
        <div class="row">
          @foreach ($resultPackage as $key => $value)

            <div class="col-lg-4 mb-4">
              <div class="card h-100">
                <h4 class="card-header">{{ $value['package_name'] }}</h4>
                <div class="card-body">
                  <p class="card-text">{{ $value['package_description'] }}</p>
                </div>
                <div class="card-footer">
                  <a href="{{ url('/package') }}" class="btn btn-danger-custom">Lihat Detail</a>
                </div>
              </div>
            </div>
            
          @endforeach
          
        </div>
        <!-- /.row -->

        <!-- Portfolio Section -->
        <ol class="breadcrumb">
          <h4>Portofolio</h4>
        </ol>

        <div class="row">

          @foreach ($resultPortofolio as $key => $value)

            <div class="col-lg-4 col-sm-6 portfolio-item">
              <div class="card h-100">
                <div class="card-body">
                <h4 class="card-title">
                    <a href="#">{{ $value['portofolio_name'] }}</a>
                  </h4>
                <!-- <a href="#"><img class="card-img-top" src="{{ url('assets/image/spect3000w.png') }}" alt=""></a> -->
                <img id="myImg" src="{{ url('public/assets/portofolio_photo').'/'.$value['portofolio_photo'] }}" alt="" width="100%" height="400">
                
                  
                  <p class="card-text">{{ $value['portofolio_description'] }}</p>
                </div>
              </div>
            </div>
              
          @endforeach
          
          
        </div>
        <!-- /.row -->

        <!-- Features Section -->
        <div class="row">
          <!-- <div class="col-lg-6"> -->
            
            <!-- <ul>
              <li>
                <strong>Bootstrap v4</strong>
              </li>
              <li>jQuery</li>
              <li>Font Awesome</li>
              <li>Working contact form with validation</li>
              <li>Unstyled page elements for easy customization</li>
            </ul> -->
            
          <!-- </div> -->
          <!-- <div class="col-lg-6">
            <h2>Kontak</h2>
            <img class="img-fluid rounded" src="http://localhost/sound/kontak.jpg" alt="">
          </div> -->
          <!-- Content Row -->
        <!-- <div class="row"> -->
          <!-- Map Column -->
          <div class="col-lg-8 mb-4">
            <!-- Embedded Google Map -->
            <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;ll=-6.894986,107.671105&amp;spn=960.506174,1090.013672&amp;t=m&amp;z=20&amp;output=embed"></iframe>
          </div>
          <!-- Contact Details Column -->
          <div class="col-lg-4 mb-4">
            <h3>Contact</h3>
            <p>
              Komplek Giri Mande B.1 no.26,
              <br>Bandung, Indonesia
              <br>
            </p>
            <p>
              <abbr title="Phone" >Telp</abbr>: <a href="tel:+6281220773339"> 0812 2077 3339 </a>
            </p>
            <p>
              <abbr title="Email">Email</abbr>:
              <a href="mailto:ikisoundsystem@yahoo.com">ikisoundsystem@yahoo.com
              </a>
            </p>
            <!-- <p>
              <abbr title="BBM">BB</abbr>:
              <a href="bbmi://5CBDD6AA" target="_blank">5CBDD6AA
              </a>
            </p> -->
            <p>
              <abbr title="instagram">Instagram</abbr>:
              <a href="#">ikisoundsystem
              </a>
            </p>
            <p>
              <abbr title="facebook">Facebook</abbr>:
              <a href="#">ikisoundsystem
              </a>
            </p>
            
          </div>
        </div>
        <!-- /.row -->
        <!-- </div> -->
        <!-- /.row -->

        <hr>

        <!-- Call to Action Section -->
        <!-- <div class="row mb-4">
          <div class="col-md-8">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum deleniti beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>
          </div>
          <div class="col-md-4">
            <a class="btn btn-lg btn-secondary btn-block" href="#">Call to Action</a>
          </div>
        </div> -->

      </div>
      <!-- /.container -->
    </div>

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

  history.pushState(null, null, document.URL);
  window.addEventListener('popstate', function () {
      history.pushState(null, null, document.URL);
  });
</script>
@endsection
