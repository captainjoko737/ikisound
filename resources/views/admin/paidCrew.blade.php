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
            {!! Form::open(array('route' => 'postCrewPayment','files'=>true)) !!}
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
                    <p>Crew Payment Successfuly</p>
                </div>
              @endif
            <div class="box-body">  

              <div class="form-group">
                <label>Select Event Name</label>
                <!-- <input type="text" class="form-control" id="event_name" name="event_name" placeholder="Enter Username" value=""> -->
                <select class="form-control" id="id_booking" name="id_booking" style="width: 100%;">
                    
                    @foreach ($resultBooking as $key => $value)
                        <option value="{{ $value['id_booking'] }}">{{ $value['event_name'] }}</option>
                    @endforeach
                </select>
              </div>

              <div class="form-group">
                <label>Select Crew Name</label>
                <!-- <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" value=""> -->
                <select class="form-control" id="id_user" name="id_user" style="width: 100%;">
                    @foreach ($resultCrew as $key => $value)
                        <option value="{{ $value['id_user'] }}">{{ $value['username'] }}</option>
                    @endforeach
                </select>
              </div>

              <div class="form-group">
                <label>Total Payment</label>
                <input type="text" class="form-control" id="salary" name="salary" placeholder="Enter Salary" value="">
              </div>
              
              <!-- <div class="form-group">
                <label>Select Status Payment</label>
                <select class="form-control" id="status_salary" name="status_salary" style="width: 100%;">
                    <option value="0">PENDING</option>
                    <option value="1">PAID</option>
                </select>
              </div> -->

             
              <div class="row">
                
                <div class="col-xs-4">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Pay</button>
                </div>
                <div class="col-xs-4">
                 
                </div>
                <div class="col-xs-4">
                  <a href="{{ url('admin/crewSalary') }}" class="btn btn-primary btn-block btn-flat">Back</a>
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




















