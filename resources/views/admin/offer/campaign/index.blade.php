@extends('layouts.admin')

@section('admin_content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Campaign</h1>
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
                            <h3 class="card-title">ALl Campaign list here:</h3>   
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="" class=" table table-bordered table-striped table-sm ytable">
                            <thead>
                            <tr>
                            <th>SL</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Discount(%)</th>
                            <th>Status</th>
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
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add new Campaign</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('campaign.store')}}"method="Post" enctype="multipart/form-data" id="add-form">
            @csrf
            <div class="modal-body">

                <div class="form-group">
                    <label for="title">Campaign Title<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="title" required>
                   <small id="emailHelp" class="form-text text-muted">This is Campaign Title/name</small>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="start_date">Start Date <span class="text-danger">*</span> </label>
                        <input type="date" class="form-control"id="input-file-now" name="start_date" required>
                    </div>
                    <div class="col-lg-6">
                        <label for="end_date">End Date<span class="text-danger">*</span></label>
                    <input type="date" class="form-control "id="input-file-now" name="end_date" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="start_date">Status<span class="text-danger">*</span> </label>
                        <select class="form-control" name="status">
                            <option value="1">Active</option>
                            <option value="0">Deactive</option>
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label for="discount">Discount (%)<span class="text-danger">*</span></label>
                    <input type="number" class="form-control "id="input-file-now" name="discount" required>
                    <small id="emailHelp" class="form-text text-danger">Discount percentage are apply for all product selling price</small>
                    </div>
                </div>
                <div class="form-group">
                    <label for="image">Campaign Image<span class="text-danget">*</span> </label>
                    <input type="file" class="form-control dropify"data-height="140" id="input-file-now" name="image" required>
                   <small id="emailHelp" class="form-text text-muted">This is your Campaign banner</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><span class="d-none">Loading...</span> Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  {{-- edit modal --}}
  <div class="modal fade" id="brandmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Campaign</h5>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
    $('.dropify').dropify({
        messages:{
            'defaoult': 'Click Here',
            'replace' : 'Drag and drop to replace',
            'remove'  : 'Remove',
            'error'   : 'Ooops, something wrong'
        }
    });
</script>

<script type="text/javascript">
  
    $(function childcategory(){
        var table=$('.ytable').DataTable({
            // $.fn.dataTable.ext.errMode = 'throw';
            processing:true,
            serverSide:true,
            ajax:"{{route('campaign.index')}}",
            columns:[
                {data:'DT_RowIndex' ,name:'DT_RowIndex'},
                {data:'start_date' ,name:'start_date'},
                {data:'end_date' ,name:'end_date'},
                {data:'title' ,name:'title'},
                {data:'image' ,name:'image', render:function(data,type, full, meta){
                    return "<img src=\"" +data+ "\" height=\" 50\">" }},
                {data:'discount' ,name:'discount'},
                {data:'status' ,name:'status'},
                {data:'action' ,name:'action',orderable:true,searchable:true},

             ]
        });
    });
</script>

<script type="text/javascript">

  $('body').on("click","#editcat", function(){
      let childcat_id = $(this).data('id');
      //alert(subcat_id);
      $.get("campaign/edit/"+childcat_id, function(data){
         $("#modal_body").html(data);
      });
   });

</script>

@endsection