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
        <p class="login-box-msg text-instead-box">Confirm password with username</p>

        <form action="{{route('postForgetPassword')}}" method="post">
          {!! csrf_field() !!}
          @if ($error)
            <div class="alert btn-danger-custom">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                
                  {{ $error }}
                
            </div>
          @elseif($success == 1) 
            <div class="alert btn-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p>new password has been sent to your email</p>
            </div>
          @endif
          <div class="form-group has-feedback">
            <label class="text-instead-box"><i class="fa fa-fw fa-user text-instead-box"></i> Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter Username">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          
          <div class="row">
            <div class="col-lg-4">
              <button type="submit" class="btn btn-danger-custom btn-flat text-center">Reset Password</button>
            </div>
            <div class="col-lg-4 text-center">
              <!-- <p class="text-instead-box">OR</p> -->
            </div>
            <div class="col-lg-4">
              <a href="{{ url('/login') }}" class="btn btn-facebook btn-flat pull-right">Back</a>
            </div>
            
          </div>
          
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
