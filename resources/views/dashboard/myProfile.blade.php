@extends ('layout.app_home')
  <style type="text/css">
    .bg {
      /*width: 520px;*/
      background-image: url(assets/image/table-bg.png);
      background-size:100% 100%;
      color:white;
    }
  </style>
@section('content')

    <div class="login-box" id="page">
      <div class="login-logo">
        
        <!-- <h3 class="navbar-brand text-instead-box" href=""><i><img src="{{ url('assets/image/logo.png') }}" width="30" height="30"> </i> IKI SOUNDSYSTEM</h3> -->
      </div>
      
    <div class="panel panel-info">
      
        <div class="panel-body">
          
            
          <div class="bg text-center" style="overflow-x:auto;"> 
            <hr>
            <h4>My Profile</h4>
            <table class="table table-user-information text-instead-box">
              <tbody>
                <tr>
                  <td><i class="fa fa-user-circle-o"></i> Username </td>
                  <td> : {{ $user->username }}</td>
                </tr>
                <tr>
                  <td><i class="fa fa-vcard-o"></i> Full Name</td>  
                  <td> : {{ $user->fullname }}</td>
                </tr>
                <tr>
                  <td><i class="fa fa-inbox"></i> Email</td>
                  <td> : {{ $user->email }}</td>
                </tr>
                <tr>
                  <td><i class="fa fa-map-marker"></i> Address</td>
                  <td> : {{ $user->address }}</td>
                </tr>
                <tr>
                  <td><i class="fa fa-mobile-phone"></i> Phone</td>
                  <td> : {{ $user->phone }}</td>
                </tr>
               
              </tbody>
            </table>
            
            <button class="btn btn-primary" onclick="updateProfile({{ $user->id_user }})">Update My Profile</button>
            <hr>
          </div>
        </div>
      </div>
    </div>
    <!-- /.login-box -->

    <div id="loading"></div>

@endsection

@section('js')

<script type="text/javascript">
  
  function updateProfile(id_user) {
      // console.log('Button Login');
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
