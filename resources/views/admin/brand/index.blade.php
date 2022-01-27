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
            <h1 class="m-0">Brand</h1>
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
                            <h3 class="card-title">ALl Brand list here:</h3>   
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="" class=" table table-bordered table-striped table-sm ytable">
                            <thead>
                            <tr>
                            <th>SL</th>
                            <th>Brand Name</th>
                            <th>Brand Slug</th>
                            <th>Brand Logo</th>
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
          <h5 class="modal-title" id="exampleModalLabel">Add new Brand</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('brand.store')}}"method="Post" enctype="multipart/form-data" id="add-form">
            @csrf
            <div class="modal-body">

                <div class="form-group">
                    <label for="brand_name">Brand Name</label>
                    <input type="text" class="form-control" name="brand_name" required>
                   <small id="emailHelp" class="form-text text-muted">This is your main Brand</small>
                </div>
                <div class="form-group">
                    <label for="brand_name">Brand Logo</label>
                    <input type="file" class="form-control dropify"data-height="140" id="input-file-now" name="brand_logo" required>
                   <small id="emailHelp" class="form-text text-muted">This is your Brand Logo</small>
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
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Brand</h5>
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
            ajax:"{{route('brand.index')}}",
            columns:[
                {data:'DT_RowIndex' ,name:'DT_RowIndex'},
                {data:'brand_name' ,name:'brand_name'},
                {data:'brand_slug' ,name:'brand_slug'},
                {data:'brand_logo' ,name:'brand_logo', render:function(data,type, full, meta){
                    return "<img src=\"" +data+ "\" height=\" 50\">" }},
                {data:'action' ,name:'action',orderable:true,searchable:true},

             ]
        });
    });
</script>

<script type="text/javascript">

  $('body').on("click","#editcat", function(){
      let childcat_id = $(this).data('id');
      //alert(subcat_id);
      $.get("brand/edit"+childcat_id, function(data){
         $("#modal_body").html(data);
      });
   });

</script>

@endsection