@extends('layouts.admin')

@section('admin_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Warehouse </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button class="btn btn-primary"data-toggle="modal" data-target="#addmodal" >+ Add New</button>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">ALl  Warehouse list here:</h3>   
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table class=" table table-bordered table-striped table-sm ytable">
                            <thead>
                            <tr>
                            <th>SL</th>
                            <th> Warehouse Name</th>
                            <th>Warehouse Address</th>
                            <th>Warehouse phone</th>
                            <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>


<!-- Modal  for Add new category-->
<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add new </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('warehouse.store')}}"method="Post" id="add-form">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="warehouse_name">Warehouse Name</label>
                    <input type="text" class="form-control" name="warehouse_name"placeholder="Warehouse Name" required>
                </div>
           
                <div class="form-group">
                    <label for="warehouse_address">Warehouse Address</label>
                    <input type="text" class="form-control" name="warehouse_address"placeholder="Warehouse Address" required>
                </div>

                <div class="form-group">
                    <label for="warehouse_phone">Warehouse Phone</label>
                    <input type="text" class="form-control" name="warehouse_phone" placeholder="Warehouse Phone" required>
                </div>
            </div>
    
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><span class="d-none loader"><i class="fas fa-spinner"></i>Loading...</span><span class="submit_btn"></span> Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  {{-- edit modal --}}
  <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update warehouse </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="modal_body"></div>
      </div>
    </div>
  </div>

{{-- <script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js')}}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
  
    $(function childcategory(){
        var table=$('.ytable').DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{route('warehouse.index')}}",
            columns:[
                {data:'DT_RowIndex' ,name:'DT_RowIndex'},
                {data:'warehouse_name' ,name:'warehouse_name'},
                {data:'warehouse_address' ,name:'warehouse_address'},
                {data:'warehouse_phone' ,name:'warehouse_phone'},
                {data:'action' ,name:'action',orderable:true,searchable:true},

             ]
        });
    });
</script>

<script type="text/javascript">

  $('#add-form').on("submit", function(){
      
     $('.loader').removeClass('d-none');
     $('.submit_btn').addClass('d-none');

   });
</script>
<script>
    // form-submit
   $('body').on("click","#editware", function(){
      let childcat_id = $(this).data('id');
      $.get("warehouse/edit"+childcat_id, function(data){
         $("#modal_body").html(data);
      });
   });
</script>



@endsection