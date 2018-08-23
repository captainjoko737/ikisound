@extends ('layout.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>&nbsp;</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">{{ ucwords(str_replace('_', ' ', Request::segment(1))) }}</a></li>
        <li class="active">{{ $title }}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{$title}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form method="post" action="{{ url('/project') }}" role="form">
                {{ csrf_field() }}
                @if (count($errors) > 0)
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                <div class="box-body">
                  <div class="form-group">
                    <label>Nama Project</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama" required="">
                  </div>

                  <div class="form-group">
                    <label>Deskripsi Project</label>
                    <textarea name="deskripsi" class="form-control" placeholder="Deskripsi" rows="6" required=""></textarea>
                  </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </section>
@endsection