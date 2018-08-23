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
            {!! Form::open(array('route' => 'putPackage','files'=>true, 'method' => 'PUT')) !!}
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
                    <p>Edit Package Successfuly</p>
                </div>
              @endif
            <div class="box-body">  

              <div class="form-group">
                <label>Package Name</label>
                <input type="text" class="form-control hidden" id="id_package" name="id_package" placeholder="Enter Package Name" value="{{ $package['id_package'] }}">
                <input type="text" class="form-control" id="package_name" name="package_name" placeholder="Enter Package Name" value="{{ $package['package_name'] }}">
              </div>

              <div class="form-group">
                <label>Package Description</label>
                <input type="text" class="form-control" id="package_description" name="package_description" placeholder="Enter Package Description" value="{{ $package['package_description'] }}">
              </div>

              <div class="form-group">
                <label>Package Price</label>
                <input type="text" class="form-control" id="package_price" name="package_price" placeholder="Enter Package Price" value="{{ $package['package_price'] }}">
              </div>

              <div class="form-group has-feedback">
                <label>Photo Profile</label>
                {!! Form::file('image_file') !!}
              </div>

              <div class="row">
                
                <div class="col-xs-4">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
                </div>
                <div class="col-xs-4">
                 
                </div>
                <div class="col-xs-4">
                  <a href="{{ url('admin/package') }}" class="btn btn-primary btn-block btn-flat">Back</a>
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




















