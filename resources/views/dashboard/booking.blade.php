@extends ('layout.app_home_booking')
  <style type="text/css">
    
  </style>
@section('content')

    <div class="login-box" id="page">

      <!-- Modal -->
      <button type="button" class="btn btn-info btn-lg" data-toggle="modal" hidden id="modal" data-target="#myModal"></button>
      <div class="modal modal-warning fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-sm">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Warning !</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              
            </div>
            <div class="modal-body">
              <p id="notification"></p>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          
        </div>
      </div>

      <div class="login-logo">
        
        <!-- <h3 class="navbar-brand text-instead-box" href=""><i><img src="{{ url('assets/image/logo.png') }}" width="30" height="30"> </i> IKI SOUNDSYSTEM</h3> -->
      </div>
      <!-- /.login-logo -->
      <div class="login-box-body-custom">
        <p class="login-box-msg text-instead-box">Booking Event</p>

        <form action="{{route('bookingSelected')}}" method="post">
          {!! csrf_field() !!}
          @if (count($errors) > 0)
            <div class="alert btn-danger-custom">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                @foreach ($errors->all() as $error)
                  {{ $error }} </br>
                @endforeach
            </div>
         
          @endif

          <div class="form-group has-feedback">
            <!-- <input type="text" class="form-control" placeholder="Tanggal Lahir" name="tanggal_lahir" id="tanggal_lahir" required> -->
            <label class="text-instead-box"><i class="fa fa-fw fa-user text-instead-box"></i> Event Date</label>
            <input type="text" id="tanggal_lahir" name="event_date" readonly class="form-control" placeholder="Select Date" value="">
            <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <label class="text-instead-box"><i class="fa fa-fw fa-user text-instead-box"></i> Event Name</label>
            <input type="text" name="event_name" id="event_name" class="form-control" placeholder="Enter Your Event Name">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          
          <div class="form-group has-feedback">
            <label class="text-instead-box"><i class="fa fa-fw fa-user text-instead-box"></i> Event Location</label>
            <input type="text" name="event_location" id="event_location" class="form-control" placeholder="Enter Your Event Location">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>

          <div class="form-group">
            <label class="text-instead-box"><i class="fa fa-fw fa-user text-instead-box"></i> Package</label>
            <select class="form-control select2" id="select2" name="select2"  multiple="multiple" data-placeholder="Select Package" style="width: 100%;">
              
              @foreach ($resultPackage as $key => $value)
                  
                  <option value="{{ $value['id_package'] }}">{{ $value['package_name'] }}</option>

              @endforeach

              
              <!-- <option>Alaska</option>
              <option>California</option>
              <option>Delaware</option>
              <option>Tennessee</option>
              <option>Texas</option>
              <option>Washington</option> -->
            </select>
          </div>

          <button type="button" id="button" class="btn btn-facebook btn-flat text-center">Booking Event Now!</button>
          <div class="row">
            <div class="col-lg-4">
              <hr>
              
            </div>
            
            <div class="col-lg-8">
              <!-- <a type="button" href="{{ url('/login') }}" class="btn btn-facebook btn-flat text-center">Register </a> -->
              <!-- <a href="{{ url('auth/login') }}" class="text-center">I already have account</a> -->
            </div>
          </div>
          <!-- <input type="button" id="button" value="check Selected"> -->
        </form>
      </div>
      <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <div id="loading"></div>

@endsection

@section('js')

<script type="text/javascript">


// Create Base64 Object
var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}

// Define the string
var string = 'Hello World!';

// Encode the String
var encodedString = Base64.encode(string);
console.log(encodedString); // Outputs: "SGVsbG8gV29ybGQh"

// Decode the String
var decodedString = Base64.decode(encodedString);
console.log(decodedString); // Outputs: "Hello World!"



  var _token = $('input[name="_token"]').val();

  $("#button").click(function(){
      // alert($(".select2").val());
      // alert("Selected value is: "+ $(".select2").val());

      var id_package     = $(".select2").val();
      var date           = document.getElementById("tanggal_lahir");
      var event_name     = document.getElementById("event_name");
      var event_location = document.getElementById("event_location");

      if (id_package == '') {
        // alert('Paket Tidak Boleh Kosong');
        document.getElementById("notification").innerHTML = 'Paket Tidak Boleh Kosong';
        document.getElementById("modal").click();
      }else if (date.value == '' ) {
        // alert('Event Date Tidak Boleh Kosong');
        document.getElementById("notification").innerHTML = 'Event Date Tidak Boleh Kosong';
        document.getElementById("modal").click();
      }else if (event_name.value == '' ) {
        // alert('Event Name Tidak Boleh Kosong');
        document.getElementById("notification").innerHTML = 'Event Name Tidak Boleh Kosong';
        document.getElementById("modal").click();
      }else if (event_location.value == '' ) {
        // alert('Event Location Tidak Boleh Kosong');
        document.getElementById("notification").innerHTML = 'Event Location Tidak Boleh Kosong';
        document.getElementById("modal").click();
      }else {
        window.location.href = "{{url("/booking/selected")}}/" + id_package + '/' + Base64.encode(date.value) + '/' + Base64.encode(event_name.value) + '/' + Base64.encode(event_location.value);
      }


      var data = {
              "id_package" : id_package,
              "event_date" : date.value,
              "event_name" : event_name.value,
              "event_location" : event_location.value,
              "_token" : _token};

        // $.ajax({
        //    type: 'post',
        //    url: '{{url("/booking/selected")}}',
        //    data: data,
        //    success: function(data) {

        //     // console.log('SUCCESS');
        //     // location.reload();
        //       console.log(data);            
        //    },
        //    error: function(data) {
        //       console.log(data);
        //        console.log("error");
        //    }
        // });

      // console.log('id package : ', id_package, ' date : ', date.value, ' event name : ', event_name.value, ' event_location : ', event_location.value);
      // console.log(date.value);

  });

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2().attr("readonly", true)

  })
  
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
