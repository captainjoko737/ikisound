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
            <p>Do you want to delete this portofolio ?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="deletePortofolio()">Delete</button>
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
                <h3 class="box-title">ADMIN PORTOFOLIO</h3>
                <a class="pull-right btn btn-success" href="{{ url('/admin/portofolio/new') }}">ADD Portofolio</a>
              </div>

              <div class="box-body" style="overflow-x:auto;">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Portofolio Name</th>
                    <th>Portofolio Description</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($resultPortofolio as $key => $value)
                
                      <tr>
                        <td>{{$key + 1}}.</td>
                        <td>{{$value['portofolio_name']}}</td>
                        <td>{{$value['portofolio_description']}}</td>
                        
                        <td>
                          <button type="button" class="btn btn-primary btn-sm" onclick="buttonEdit({{$value['id_portofolio']}})">Edit</button>
                          <button type="button" class="btn btn-danger btn-sm" onclick="ButtonDetail({{$value['id_portofolio']}})">Delete</button>
                        </td>
                      </tr>

                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Portofolio Name</th>
                    <th>Portofolio Description</th>
                    <th>Aksi</th>
                  </tr>
                  </tfoot>
                </table>
                
              </div>
              
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

  function ButtonDetail(id_portofolio) {
      console.log(id_portofolio);

      selectedID = id_portofolio;
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

  function deletePortofolio() {
    
      var data = {
              "id_portofolio" : selectedID,
              "_token" : _token};

      $.ajax({
         type: 'delete',
         url: '{{url("/admin/portofolio")}}',
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

  function buttonEdit(id_portofolio) {
      location.href='{{url("/admin/portofolio/edit/")}}/'+id_portofolio;
  }

</script>

@endsection




















