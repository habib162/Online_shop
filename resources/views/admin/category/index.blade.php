@extends('layouts.admin')

@section('admin_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button class="btn btn-primary"data-toggle="modal" data-target="#categorymodal" >+ Add New</button>
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
                            <h3 class="card-title">ALl category list here:</h3>   
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped table-sm yajratable">
                            <thead>
                            <tr>
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Category Slug</th>
                            <th>Home Page</th>
                            <th>Icon</th>
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
<div class="modal fade" id="categorymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('category.store')}}"method="Post"enctype="multipart/form-data" >
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="category_name">Category Name</label>
                    <input type="text" class="form-control" id="category_name" name="category_name" required>
                   <small id="emailHelp" class="form-text text-muted">This is your main category</small>
                </div>
                <div class="form-group">
                  <label for="home_page">Home Page</label>
                  <select name="home_page" class="form-control">
                    <option value="1">yes</option>
                    <option value="0">no</option>
                  </select>
                 <small id="emailHelp" class="form-text text-muted">This is just for showing home page</small>
              </div>
              <div class="form-group">
                <label for="brand_name">Icon</label>
                <input type="file" class="form-control dropify"name="icon">
               <small id="emailHelp" class="form-text text-muted">This is your Category Icon</small>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  {{-- edit modal --}}
  <div class="modal fade" id="catmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
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
          var table=$('.yajratable').DataTable({
              // $.fn.dataTable.ext.errMode = 'throw';
              processing:true,
              serverSide:true,
              ajax:"{{route('category.index')}}",
              columns:[
                  {data:'DT_RowIndex' ,name:'DT_RowIndex'},
                  {data:'category_name' ,name:'category_name'},
                  {data:'category_slug' ,name:'category_slug'},
                  {data:'home_page' ,name:'home_page'},
                  {data:'icon' ,name:'icon', render:function(data,type, full, meta){
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
        $.get("category/edit"+childcat_id, function(data){
            $("#modal_body").html(data);
        });
      });
  
  </script>
  

@endsection