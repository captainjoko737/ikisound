@extends ('layout.app_home_booking')
  <style type="text/css">
    .bg {
      /*width: 520px;*/
      background-image: url(../assets/image/table-bg.png);
      background-size:100% 100%;
      padding-left: 10%;
      padding-right: 10%;
      color:white;
    }
  </style>
@section('content')

    <div class="container" style="overflow-x:auto;" id="page">
      <hr>
      <div class="text-instead-box bg">
        <hr>
        <h4 class="text-center">Informasi</h4>           
        </br>
        <p>Terima kasih telah menggunakan fasilitas booking online di ikisoundsystem.com, customer service kami akan segera menghubungi anda di nomor hp yang tertera di akun anda.</p>
        <p></p>
        <p>Kami telah mencatat jadwal anda dan bisa di cek di menu schedule.</p>
        <p></p>
        <p></p>
      </br>
      </div>
    </div>

    <div id="loading"></div>

@endsection

@section('js')

<script type="text/javascript">
  
  history.pushState(null, null, document.URL);
  window.addEventListener('popstate', function () {
      history.pushState(null, null, document.URL);
  });


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
