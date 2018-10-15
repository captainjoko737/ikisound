@extends ('layout.app_home')
  <style type="text/css">
    .bg {
      /*width: 520px;*/
      /*background-image: url(assets/image/table-bg.png);*/
      background:url('../../../../../assets/image/table-bg.png');
      background-size:100% 100%;
      color:white;
    }
  </style>
@section('content')

    {!! csrf_field() !!}
    <!-- Main content -->
    <section class="invoice" id="page">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h3 class="page-header">
            <i class="fa fa-globe"></i> Confirmation Booking
            
          </h3>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>Admin, IKISOUNDSYSTEM</strong><br>
            Phone / WA : (804) 123-5432<br>
            Email: info@almasaeedstudio.com
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong>{{ $user['fullname'] }}</strong><br>
            Event Date : {{ $event_date_string }}<br>
            Event Name : {{ $event_name }}<br>
            Event Location : {{ $event_location }}<br>
            Phone: {{ $user['phone'] }}<br>
            Email: {{ $user['email'] }}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              
              <th>Package</th>
              <th>Package Price</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($package as $key => $value)
                <tr>
                  <td>{{ $value['package_name'] }}</td>
                  <td>{{ $value['package_price_string'] }}</td>
                  <td>{{ $value['package_price_string'] }}</td>
                </tr>
            @endforeach

            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-6 pull-right">
         
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th>Total:</th>
                <td>{{ $total_price }}</td>
              </tr>
            </table>
            <div class="form-group">
              <label><i class="fa fa-fw fa-user"></i> Offer Discount</label> 
              <select class="form-control" id="offer_discount" name="offer_discount" style="width: 100%;">
                  <option value="0">0 %</option>
                  <option value="5">5 %</option>
                  <option value="10">10 %</option>
              </select>           
            </div>
            <hr>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">


          <button type="button" onclick="window.history.go(-1); return false;" class="btn btn-danger pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Back
          </button> 
          <button type="button"  onclick="buttonSubmit()" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Confirm
          </button>
        </div>
      </div>
    </section>

    <div id="loading"></div>

@endsection

@section('js')

<script type="text/javascript">

  var _token = $('input[name="_token"]').val();

  function buttonSubmit() {

    show('page', false);
    show('loading', true);

    var user = '{!! $user !!}';
    var user = JSON.parse(user);

    var packages = [@foreach($package as $k => $info)
       '{{ $info['id_package'] }}',
    @endforeach ]

    var event_date      = '{!! $event_date !!}';
    var event_name      = '{!! $event_name !!}';
    var event_location  = '{!! $event_location !!}';
    var discount        = parseInt(document.getElementById('offer_discount').value);
    var customer_offer  = {!! $total_price_int !!};

    if (discount != 0 && discount != '') {
      
        var dc = customer_offer * discount / 100;
        customer_offer = (customer_offer - dc);
        
    }else{
        discount = 0;
    }

    var data = {
          "_token"          : _token,
          "package"         : packages,
          "id_user"         : user.id_user,
          "booking_date"    : event_date,
          "event_name"      : event_name,
          "event_location"  : event_location,
          "discount_offer"  : discount,
          "customer_offer"  : customer_offer,
          "approved_offer"  : 0,
          "status_booking"  : 0};

    $.ajax({
       type: 'post',
       url: '{{url("/booking/confirmation")}}',
       data: data,
       success: function(data) {

          // console.log('SUCCESS');
          // location.reload();
          // console.log(data);  
          
          window.location.href = "{{url("/booking/finished")}}";

       },
       error: function(data) {
          console.log(data);
           console.log("error");
       }
    });
  }

  $('select[name=offer_discount]').val(1);
  
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
