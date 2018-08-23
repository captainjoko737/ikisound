@extends ('layout.app')

@section('content')


    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ $title }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(array('route' => 'postNewApproved','files'=>true)) !!}
            <!-- <form action="register" method="post"> -->
            {!! csrf_field() !!}
            @if (count($errors) > 0)
                <div class="alert btn-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    @foreach ($errors->all() as $error)
                      {{ $error }} </br>
                    @endforeach
                </div>
             @elseif($success == 1) 
                <div class="alert btn-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p>Approve Booking Successfuly</p>
                </div>
              @endif
            <div class="box-body">  

              <div class="form-group">
                <label>Customer Offer</label>
                <input type="text" class="form-control" id="price_approved" readonly name="price_approved" placeholder="Enter Price Approved" value="{{ $customer_offer }}">
              </div>

              <div class="form-group">
                <label>Price Approved</label>
                <input type="text" class="form-control" id="price_approved" name="price_approved" placeholder="Enter Price Approved" value="{{ $approved_offer }}">
                <input type="text" class="form-control hidden" id="id_booking" name="id_booking" value="{{ $id_booking }}">
              </div>

              <div class="form-group">
                <label>Status Booking</label>
                <!-- <input type="text" class="form-control" id="package_description" name="package_description" placeholder="Enter Package Description" value=""> -->
              <select class="form-control" id="status_booking" name="status_booking" style="width: 100%;">
                        <option value="">- Select Status -</option>
                        <option value="0">WAITING</option>
                        <option value="1">CONFIRMED</option>
                        <option value="2">FINISHED</option>
                        <option value="3">REJECTED</option>
                   
              </select>

              </div>
             
              <div class="row">
                
                <div class="col-xs-4">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
                </div>
                <div class="col-xs-4">
                 
                </div>
                <div class="col-xs-4">
                  <a href="{{ url('admin/booking') }}" class="btn btn-primary btn-block btn-flat">Back</a>
                </div>
                
              </div>

            </div>

            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
@endsection

@section('js')

<script>


</script>
  
@endsection




















