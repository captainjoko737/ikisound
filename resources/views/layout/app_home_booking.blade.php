<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="{{ url('public/assets/image/logo.png') }}" type="image/x-icon" />
  <title>{{ $title }} | IKISoundSystem</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('public/assets/bower_components/bootstrap/dist/css/bootstrap-template.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('public/assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('public/assets/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- daterange picker -->
  <!-- <link rel="stylesheet" href="{{ url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}"> -->
  <!-- bootstrap datepicker -->
  <!-- <link rel="stylesheet" href="{{ url('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"> -->
  <!-- iCheck for checkboxes and radio inputs -->
  <!-- <link rel="stylesheet" href="{{ url('assets/plugins/iCheck/all.css') }}"> -->
  <!-- Bootstrap Color Picker -->
  <!-- <link rel="stylesheet" href="{{ url('assets/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}"> -->
  <!-- Bootstrap time Picker -->
  <!-- <link rel="stylesheet" href="{{ url('assets/plugins/timepicker/bootstrap-timepicker.min.css') }}"> -->
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('public/assets/dist/css/loading.css') }}">
  <link rel="stylesheet" href="{{ url('public/assets/dist/css/background-image.css') }}">
  <link rel="stylesheet" href="{{ url('public/assets/bower_components/jquery-ui/jquery-ui.css') }}">
  <link rel="stylesheet" href="{{ url('public/assets/bower_components/select2/dist/css/select2.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('public/assets/dist/css/AdminLTECustom.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <!-- <link rel="stylesheet" href="{{ url('assets/dist/css/skins/_all-skins.min.css') }}"> -->
  <link href="{{ url('public/assets/bower_components/modern-business/modern-business.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('public/assets/bower_components/font-awesome/css/font-awesome.min.css') }}">

  @yield('css')
</head>

<body>
  @include ('layout.header_home')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      @yield ('content')
    <!-- /.content -->
  </div>

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; IKI SOUNDSYSTEM 2018</p>
    </div>
    <!-- /.container -->
  </footer>

<!-- jQuery 3 -->
<script src="{{ url('public/assets/bower_components/jquery/dist/jquery-template.min.js') }}"></script>
<script src="{{ url('public/assets/bower_components/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ url('public/assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ url('public/assets/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ url('public/assets/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ url('public/assets/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

<!-- date-range-picker -->
<script src="{{ url('public/assets/bower_components/moment/min/moment.min.js') }}"></script>
<!-- <script src="{{ url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script> -->
<!-- bootstrap datepicker -->
<script src="{{ url('public/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- bootstrap color picker -->
<!-- <script src="{{ url('assets/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script> -->
<!-- bootstrap time picker -->

<script src="{{ url('public/assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ url('public/assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{ url('public/assets/plugins/iCheck/icheck.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ url('public/assets/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('public/assets/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('public/assets/dist/js/demo.js') }}"></script>

<script src="{{ url('public/assets/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>

<script src="{{ url('public/assets/bower_components/moment/moment.js') }}"></script>
<script src="{{ url('public/assets/bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
@yield('js')


<script>
  
  

  $(function() {
      $( "#tanggal_lahir" ).datepicker({
          dateFormat : 'yy-mm-dd',
          changeMonth : true,
          changeYear : true,
          minDate: 'dateToday',
          yearRange: '-100y:c+nn'
      });
  });

  
</script>
</body>
</html>
