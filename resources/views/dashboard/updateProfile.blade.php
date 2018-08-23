@extends ('layout.app_home')
  <style type="text/css">
    
  </style>
@section('content')

    <div class="login-box" id="page">
      <div class="login-logo">
        
        <!-- <h3 class="navbar-brand text-instead-box" href=""><i><img src="{{ url('assets/image/logo.png') }}" width="30" height="30"> </i> IKI SOUNDSYSTEM</h3> -->
      </div>
      <!-- /.login-logo -->
      <div class="login-box-body-custom">
        <p class="login-box-msg text-instead-box">Update Profile</p>

        <form action="{{route('updateProfile')}}" method="post">
          {!! csrf_field() !!}
          @if (count($errors) > 0)
            <div class="alert btn-danger-custom">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                @foreach ($errors->all() as $error)
                  {{ $error }} </br>
                @endforeach
            </div>
         @elseif($success == 1) 
            <div class="alert btn-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p>Your Profile Has Been Updated</p>
            </div>
          @endif
          <div class="form-group has-feedback">
            <label class="text-instead-box"><i class="fa fa-fw fa-user text-instead-box"></i> Username</label>
            <input type="text" name="id_user" class="form-control" placeholder="Enter Your Username" hidden value="{{ $user->id_user }}">
            <input type="text" name="username" class="form-control" placeholder="Enter Your Username" value="{{ $user->username }}">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <label class="text-instead-box"><i class="fa fa-fw fa-user text-instead-box"></i> Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter New Password" value="">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <label class="text-instead-box"><i class="fa fa-fw fa-user text-instead-box"></i> Full Name</label>
            <input type="text" name="fullname" class="form-control" placeholder="Enter Your Full Name" value="{{ $user->fullname }}">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <label class="text-instead-box"><i class="fa fa-fw fa-user text-instead-box"></i> Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter Your Email Address" value="{{ $user->email }}">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <label class="text-instead-box"><i class="fa fa-fw fa-user text-instead-box"></i> Address</label>
            <input type="text" name="address" class="form-control" placeholder="Enter Your Address" value="{{ $user->address }}">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <label class="text-instead-box"><i class="fa fa-fw fa-user text-instead-box"></i> Phone Number</label>
            <input type="text" name="phone" class="form-control" placeholder="Enter Your Phone Number" value="{{ $user->phone }}">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>

          <div class="row">
            <div class="col-lg-4">
              <hr>
              <button type="submit" class="btn btn-facebook btn-flat text-center">Save Setting</button>
            </div>
            <div class="col-lg-4">
              <hr>
              <!-- <button type="submit" class="btn btn-facebook btn-flat text-center">Save Setting</button> -->
            </div>
            <div class="col-lg-4">
              <hr>
              <button type="button" onclick="buttonBack({{$user->id_user}})" class="btn btn-facebook btn-flat text-center">Back </Button>
              <!-- <a type="button" href="{{ url('/updateProfile/') }}" class="text-center">I already have account</a> -->
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
  
  function buttonBack(id_user) {
      location.href='/updateProfile/'+id_user;

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
