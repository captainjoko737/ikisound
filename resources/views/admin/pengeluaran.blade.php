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
            <p>Do you want to delete this outcome ?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="deleteAdmin()">Delete</button>
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
                <h3 class="box-title">Pengeluaran</h3>
                <a class="pull-right btn btn-success" href="{{ url('/admin/crewSalary/paid') }}">Tambah</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body" style="overflow-x:auto;">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Jenis Pengeluaran</th>
                    <th>Jumlah Pengeluaran</th>
                    <th>Tanggal Pengeluaran</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($result as $key => $value)
                
                  <tr>
                    <td>{{$key + 1}}.</td>
                    <td>{{$value['nama']}}</td>
                    <td>Rp. {{ number_format($value['jumlah'], 2) }}</td>
                    <td>{{ date('l, d F Y', strtotime($value['created_at'])) }}</td>
                    <td>
                      
                          <button type="button" class="btn btn-info btn-sm" onclick="ButtonDelete({{$value['id']}})"><i class="fa  fa-pencil"></i></button>
                          <button type="button" class="btn btn-danger btn-sm" onclick="ButtonDelete({{$value['id']}})"><i class="fa  fa-trash"></i></button>
                        
                    </td>
                  </tr>

                @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Jenis Pengeluaran</th>
                    <th>Jumlah Pengeluaran</th>
                    <th>Tanggal Pengeluaran</th>
                    <th>Aksi</th>
                  </tr>
                  </tfoot>
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

  function ButtonDelete(id_crew_salary) {
      console.log(id_crew_salary);

      selectedID = id_crew_salary;
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

  function deleteAdmin() {
      console.log('INI AKAN DI HAPUS : ', selectedID);

      var data = {
              "id_crew_salary" : selectedID,
              "_token" : _token};

        $.ajax({
           type: 'delete',
           url: '{{url("/admin/crewSalary")}}',
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

