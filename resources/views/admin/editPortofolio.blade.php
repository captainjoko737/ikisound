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
            {!! Form::open(array('route' => 'putPortofolio','files'=>true, 'method' => 'PUT')) !!}
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
                    <p>Edit Prtofolio Successfuly</p>
                </div>
              @endif
            <div class="box-body">  

              <div class="form-group">
                <label>Portofolio Name</label>
                <input type="text" class="form-control hidden" id="id_portofolio" name="id_portofolio" placeholder="Enter Portofolio Name" value="{{ $portofolio['id_portofolio'] }}">
                <input type="text" class="form-control" id="portofolio_name" name="portofolio_name" placeholder="Enter Portofolio Name" value="{{ $portofolio['portofolio_name'] }}">
              </div>

              <div class="form-group">
                <label>Portofolio Description</label>
                <input type="text" class="form-control" id="portofolio_description" name="portofolio_description" placeholder="Enter Portofolio Description" value="{{ $portofolio['portofolio_description'] }}">
              </div>

              <div class="form-group has-feedback">
                <label>Portofolio Photo</label>
                {!! Form::file('image_file') !!}
              </div>

              <div class="row">
                
                <div class="col-xs-4">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
                </div>
                <div class="col-xs-4">
                 
                </div>
                <div class="col-xs-4">
                  <a href="{{ url('admin/portofolio') }}" class="btn btn-primary btn-block btn-flat">Back</a>
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




















