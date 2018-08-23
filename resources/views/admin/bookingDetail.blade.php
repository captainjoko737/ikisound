@extends ('layout.app')

@section('content')

    {!! csrf_field() !!}
    <!-- Main content -->
    <section class="invoice" id="page">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h3 class="page-header">
             Booking Detail
          </h3>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <!-- <div class="col-sm-4 invoice-col"> -->
         <!--  From
          <address>
            <strong>Admin, IKISOUNDSYSTEM</strong><br>
            Phone / WA : (804) 123-5432<br>
            Email: info@almasaeedstudio.com
          </address> -->
        <!-- </div> -->
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong>{{ $resultBooking['fullname'] }}</strong><br>
            Event Date : {{ $resultBooking['booking_date'] }}<br>
            Event Name : {{ $resultBooking['event_name'] }}<br>
            Event Location : {{ $resultBooking['event_location'] }}<br>
            Phone: {{ $resultBooking['phone'] }}<br>
            Email: {{ $resultBooking['email'] }}
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

            @foreach ($resultPackage as $key => $value)
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
        <div class="col-xs-8">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-3">
          
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Price Normal</th>
                <td>{{ $total_price_string }}</td>
              </tr>
              <tr>
                <th style="width:50%">Price Offer</th>
                <td>{{ $total_price_offer_string }}</td>
              </tr>
              <tr>
                <th style="width:50%">Price Offer Approved</th>
                <td>{{ $total_price_approved_offer_string }}</td>
              </tr>
              
              
            </table>
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
          
        </div>
      </div>
    </section>

    <div id="loading"></div>

@endsection

@section('js')

<script type="text/javascript">

  var _token = $('input[name="_token"]').val();

  function buttonSubmit() {

    
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
