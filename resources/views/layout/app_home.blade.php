<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    <meta name="description" content="">
    <meta name="author" content="">

    <meta 
     name= "viewport" 
     content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
    <link rel="shortcut icon" href="{{ url('public/assets/image/logo.png') }}" type="image/x-icon" />
    <title>{{ $title }} | IKISoundSystem</title>

    <link rel="stylesheet" href="{{ url('public/assets/dist/css/AdminLTECustom.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/bower_components/fullcalendar/dist/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/bower_components/fullcalendar/dist/fullcalendar.print.min.css') }}" media="print">

    <link rel="stylesheet" href="{{ url('public/assets/dist/css/loading.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/dist/css/background-image.css') }}">
    <!-- Bootstrap core CSS -->
    <link href="{{ url('public/assets/bower_components/bootstrap/dist/css/bootstrap-template.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('public/assets/dist/css/skins/_all-skins.min.css') }}">

    <!-- Custom styles for this template -->
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

    <!-- Bootstrap core JavaScript -->
    <script src="{{ url('public/assets/bower_components/jquery/dist/jquery-template.min.js') }}"></script>
    <script src="{{ url('public/assets/bower_components/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    @yield('js')
    <script src="{{ url('public/assets/bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ url('public/assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ url('public/assets/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
   
    <script src="{{ url('public/assets/dist/js/adminlte.min.js' ) }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ url('public/assets/dist/js/demo.js') }}"></script>
    <!-- fullCalendar -->
    <script src="{{ url('public/assets/bower_components/moment/moment.js') }}"></script>
    <script src="{{ url('public/assets/bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>

  </body>

</html>

