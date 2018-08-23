@extends ('layout.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>&nbsp;</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">{{ $title }}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data {{ $title }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @if(Session::has('berhasil'))
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                  {{ session('berhasil') }}
                </div>
              @endif
              @if(Session::has('gagal'))
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-times"></i> Gagal!</h4>
                  {{ session('gagal') }}
                </div>
              @endif
              <a href="{{url('/project/create')}}" class="btn btn-primary">Tambah Data</a>
              <hr>
              <table id="data-table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th width="135px"></th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection

@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection


@section('js')
  <!-- DataTables -->
  <script src="{{ url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

  <script>
    $(function () {
      $('#example1').DataTable()
      
      $('#data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ url('ajax/project') }}",
          columns: [
              { data: 'project_id', name: 'project_id' },
              { data: 'nama', name: 'nama' },
              { data: 'deskripsi', name: 'deskripsi', orderable: false, searchable: false },
              { data: 'action', name: 'action', orderable: false, searchable: false}
          ]
      });
    })
  </script>
@endsection