@extends ('layout.app_home')
  <style type="text/css">
    
  </style>
@section('content')

    <div class="login-box" id="page">
      <!-- <div class="logsin-logo"> -->
        
        <!-- <h3 class="navbar-brand text-instead-box" href=""><i><img src="{{ url('assets/image/logo.png') }}" width="30" height="30"> </i> IKI SOUNDSYSTEM</h3> -->
      <!-- </div> -->
      <!-- /.login-logo -->
      <div class="login-box-body-custom">
        <p class="login-box-msg text-instead-box">Log in to start your session</p>

        <form action="{{route('postLogin')}}" method="post">
          {!! csrf_field() !!}
          @if (count($errors) > 0)
            <div class="alert btn-danger-custom">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                @foreach ($errors->all() as $error)
                  {{ $error }}
                @endforeach
            </div>
          @endif
          <div class="form-group has-feedback">
            <label class="text-instead-box"><i class="fa fa-fw fa-user text-instead-box"></i> Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter Username">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <label class="text-instead-box"><i class="fa fa-fw fa-lock text-instead-box"></i> Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-lg-4">
              <button type="submit" class="btn btn-danger-custom btn-flat text-center">Log In</button>
            </div>
            <div class="col-lg-4 text-center">
              <p class="text-instead-box">OR</p>
            </div>
            <div class="col-lg-4">
              <a href="{{ url('/register') }}" class="btn btn-facebook btn-flat text-center">Register</a>
            </div>
            
          </div>
          <hr>
          <a href="{{ url('/forgetPassword') }}" class=" text-center">Forget My Password</a>
        </form>

        <hr>

      </div>
      <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <div id="loading"></div>

@endsection

@section('js')

<script type="text/javascript">
  
  function buttonLogin() {
      console.log('Button Login');

  }

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
