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
            <p>Do you want to delete this package ?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="deletePackage()">Delete</button>
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
                <h3 class="box-title">ADMIN PACKAGE</h3>
                <a class="pull-right btn btn-success" href="{{ url('/admin/package/new') }}">ADD Package</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body" style="overflow-x:auto;">
                <table class="table table-bordered">
                  
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Package Name</th>
                    <th>Package Description</th>
                    <th>Package Price</th>
                    <th></th>
                  </tr>

                  @foreach ($resultPackage as $key => $value)
                
                    <tr>
                      <td>{{$key + 1}}.</td>
                      <td>{{$value['package_name']}}.</td>
                      <td>{{$value['package_description']}}</td>
                      <td width="30%">{{$value['package_price']}}</td>
                      
                      <td>
                        <button type="button" class="btn btn-primary btn-sm" onclick="buttonEdit({{$value['id_package']}})">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="ButtonDetail({{$value['id_package']}})">Delete</button>
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

  function ButtonDetail(id_package) {
      console.log(id_package);

      selectedID = id_package;
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

  function deletePackage() {
      console.log('INI AKAN DI HAPUS : ', selectedID);

      var data = {
              "id_package" : selectedID,
              "_token" : _token};

        $.ajax({
           type: 'delete',
           url: '{{url("/admin/package")}}',
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

  function buttonEdit(id_package) {
      console.log(id_package);

      location.href='/admin/package/edit/'+id_package;
  }

</script>

@endsection




















