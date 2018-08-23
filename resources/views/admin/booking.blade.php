@extends ('layout.app')

@section('content')

    <!-- Modal -->
    <div class="modal fade modal-warning" id="myModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Warning</h4>
          </div>
          <div class="modal-body">
            <p>Do you want to delete this Booking ?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="deleteBooking()">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Content Header (Page header) -->
  {{ csrf_field() }}
    <section class="content">
      <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">BOOKING</h3>
                <!-- <a class="pull-right btn btn-success" href="{{ url('/admin/allAdmin/new') }}">Add New Admin</a> -->
              </div>
              <!-- /.box-header -->
              <div class="box-body" style="overflow-x:auto;">
                <table class="table table-bordered">
                  
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Customer</th>
                    <th>Booking Date</th>
                    <th>Event Name</th>
                    <th>Event Location</th>
                    <th>Discount Offer</th>
                    <th>Customer Offer</th>
                    <th>Approved Offer</th>
                    <th>Status</th>
                    <th></th>
                  </tr>

                  @foreach ($resultBooking as $key => $value)
                
                    <tr>
                      <td>{{$key + 1}}.</td>
                      <td>{{$value['username']}}</td>
                      <td>{{$value['booking_date']}}</td>
                      <td>{{$value['event_name']}}</td>
                      <td>{{$value['event_location']}}</td>
                      <td>{{$value['discount_offer']}} %</td>
                      <td>{{$value['customer_offer']}}</td>
                      <td>{{$value['approved_offer']}}</td>
                      <td>{{$value['status_booking']}}</td>
                      <td>
                        <!-- <button type="button" class="btn btn-primary btn-sm" onclick="buttonEdit({{$value['id_package']}})">Reset Password</button> -->
                        
                        <div class="text-center">
                          <a class="btn btn-social-icon btn-bitbucket" onclick="ButtonEdit({{$value['id_booking']}})"><i class="fa fa-eye"></i></a>
                          <a class="btn btn-social-icon btn-dropbox" onclick="ButtonConfirmation({{ $value['id_booking']}})"> <i class="fa fa-pencil"></i></a>
                          <a class="btn btn-social-icon btn-danger" onclick="ButtonDelete({{$value['id_booking']}})"><i class="fa fa-trash"></i></a>
                          
                        </div>
                      </td>
                    </tr>

                  @endforeach
                  
                  
                </table>
              </div>
              
            </div>
            
          </div>
          <!-- /.col -->
         
        </div>
      </div>
@endsection

@section('js')

<script>

var _token = $('input[name="_token"]').val();
  
  var selectedID = 0;

  function ButtonEdit(id_booking) {
    window.location.href = "/admin/bookingDetail/" + id_booking;
  }

  function ButtonDelete(id_booking) {
      console.log(id_booking);

      selectedID = id_booking;
      $("#myModal").on("show", function() {    
          $("#myModal a.btn").on("click", function(e) {
              console.log("button pressed");
              $("#myModal").modal('hide');     
          });
      });
      $("#myModal").on("hide", function() {   
          $("#myModal a.btn").off("click");
      });

      $("#myModal").on("hidden", function() {  
          $("#myModal").remove();
      });

      $("#myModal").modal({                    
        "backdrop"  : "static",
        "keyboard"  : true,
        "show"      : true                     
      });
  }

  function ButtonConfirmation(id_booking) {
      window.location.href = "/admin/booking/approve/" + id_booking;
  }

  function deleteBooking() {
      console.log('INI AKAN DI HAPUS : ', selectedID);

      var data = {
              "id_booking" : selectedID,
              "_token" : _token};

        $.ajax({
           type: 'delete',
           url: '{{url("/admin/booking")}}',
           data: data,
           success: function(data) {

            // console.log('SUCCESS');
            location.reload();
              // console.log(data);            
           },
           error: function(data) {
              console.log(data);
               console.log("error");
           }
        });

  }

</script>

@endsection




















