@extends('layouts.admin')

@section('admin_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Child Category</h1>
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
                            <h3 class="card-title">ALl Child category list here:</h3>   
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="" class=" table table-bordered table-striped table-sm ytable">
                            <thead>
                            <tr>
                            <th>SL</th>
                            <th> childcategory Name</th>
                            <th>subcategory Name</th>
                            <th>Category Name</th>
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
          <h5 class="modal-title" id="exampleModalLabel">Add new Child Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('childcategory.store')}}"method="Post" id="add-form">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="category_name">Category/subcategory Name</label>
                    <select class="form-control" name="subcategory_id" required="">
                      @foreach ($category as $row )
                        @php
                         $subcat=DB::table('subcategories')->where('category_id',$row->id)->get();
                        @endphp   
                          <option disabled="" style="color: yellow;">{{$row->category_name}}</option>
                            @foreach ($subcat as $row )
                              <option value="{{$row->id}}">---{{$row->subcategory_name}}</option>
                            @endforeach
                      @endforeach 
                    </select>
                </div>
                <div class="form-group">
                    <label for="childcategory_name">Child-Category Name</label>
                    <input type="text" class="form-control" name="childcategory_name" required>
                   <small id="emailHelp" class="form-text text-muted">This is your child category</small>
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
  <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Child-Category</h5>
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
            // $.fn.dataTable.ext.errMode = 'throw';
            processing:true,
            serverSide:true,
            ajax:"{{route('childcategory.index')}}",
            columns:[
                {data:'DT_RowIndex' ,name:'DT_RowIndex'},
                {data:'childcategory_name' ,name:'childcategory_name'},
                {data:'subcategory_name' ,name:'subcategory_name'},
                {data:'category_name' ,name:'category_name'},
                {data:'action' ,name:'action',orderable:true,searchable:true},

             ]
        });
    });
</script>

<script type="text/javascript">

  $('body').on("click","#editcat", function(){
      let childcat_id = $(this).data('id');
      //alert(subcat_id);
      $.get("childcategory/edit"+childcat_id, function(data){
         $("#modal_body").html(data);
      });
   });

</script>

@endsection