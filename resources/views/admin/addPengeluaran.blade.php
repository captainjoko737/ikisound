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
            {!! Form::open(array('route' => 'postPengeluaran','files'=>true)) !!}
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
                    <p>Create Pengeluaran Successfuly</p>
                </div>
              @endif
            <div class="box-body">  

              <div class="form-group">
                <label>Jenis Pengeluaran</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Jenis Pengeluaran" value="">
              </div>

              <div class="form-group">
                <label>Jumlah Pengeluaran</label>
                <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah Pengeluaran" value="">
              </div>

              <div class="row">
                
                <div class="col-xs-4">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
                </div>
                <div class="col-xs-4">
                 
                </div>
                <div class="col-xs-4">
                  <a href="{{ url('admin/pengeluaran') }}" class="btn btn-primary btn-block btn-flat">Back</a>
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




















