@extends('layouts.admin')

@section('admin_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Sub Category</h1>
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
                          <table id="example1" class="table table-bordered table-striped table-sm">
                            <thead>
                            <tr>
                            <th>SL</th>
                            <th> Sub-Category Name</th>
                            <th>Sub-Category Slug</th>
                            <th>Category Name</th>
                            <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ( $data as $key=>$row ) 
                            <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{$row->subcategory_name}}</td>
                            <td>{{$row->subcat_slug}}</td>
                            <td>{{$row->category_name}}</td>
                            <td>
                                <a href="#"id="editcat" class=" btn btn-info btn-sm " data-id="{{ $row->id }}"  data-toggle="modal" data-target="#editmodal" ><i class="fas fa-edit"></i></a>
                                <a href="{{route('subcategory.delete',$row->id)}}" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>
                                {{-- <a href="" class="btn btn-success btn-sm">view</a> --}}
                            </td>
                            </tr>
                            @endforeach
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
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('subcategory.store')}}"method="Post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="category_name">Category Name</label>
                    <select class="form-control" name="category_id" required="">
                        @foreach ($category as $row )
                            <option value="{{$row->id}}">{{$row->category_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="subcategory_name">Sub-Category Name</label>
                    <input type="text" class="form-control" name="subcategory_name" required>
                   <small id="emailHelp" class="form-text text-muted">This is your Sub category</small>
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
  <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Sub-Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="modal_body"></div>
      </div>
    </div>
  </div>

  <script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js')}}"></script>


<script type="text/javascript">

  $('body').on("click","#editcat", function(){
      let subcat_id = $(this).data('id');
      //alert(subcat_id);
      $.get("subcategory/edit"+subcat_id, function(data){
         $("#modal_body").html(data);
      });
   });

</script>

@endsection