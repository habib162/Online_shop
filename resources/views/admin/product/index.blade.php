@extends('layouts.admin')

@section('admin_content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Product</h1>
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
                            <h3 class="card-title">ALl Product list here:</h3>   
                        </div><br>
                        <div class=" row p-2">
                            <div class="form-group col-3">
                                <label for="">Category</label>
                                <select name="category_id" class="form-control submittable" id="category_id">
                                    <option value="">All</option>
                                    @foreach ($category as $row )
                                        <option value="{{$row->id}}">{{$row->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="">Brand</label>
                                <select name="brand_id" class="form-control submittable" id="brand_id">
                                    <option value="">All</option>
                                    @foreach ($brand as $row )
                                        <option value="{{$row->id}}">{{$row->brand_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="">WareHoouse</label>
                                <select name="warehouse" class="form-control submittable" id="warehouse">
                                    <option value="">All</option>
                                    @foreach ($warehouse as $row )
                                        <option value="{{$row->warehouse_name}}">{{$row->warehouse_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="form-group col-3">
                                <label for="">Status</label>
                                <select name="status" class="form-control submittable" id="status">
                                    <option value="">All</option>
                                        <option value="1">Active</option>
                                        <option value="0">Deactive</option>
                                </select>
                            </div> --}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="" class=" table table-bordered table-striped table-sm ytable">
                            <thead>
                            <tr>
                            <th>SL</th>
                            <th>Thumbnail</th>
                            <th>Product Name</th>
                            <th>Product Code</th>
                            <th>Category</th>
                            <th>Sub-category</th>
                            <th>Brand</th>
                            <th>Featured</th>
                            <th>Today Deal</th>
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


{{-- <script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js')}}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script type="text/javascript">
  
    $(function products(){
        table=$('.ytable').DataTable({
            // $.fn.dataTable.ext.errMode = 'throw';
            "processing":true,
            "serverSide":true,
            "searching":true,
            "ajax":{
                "url":"{{route('product.index')}}",
                "data":function(e){
                    e.category_id=$("#category_id").val();
                    e.brand_id=$("#brand_id").val();
                    e.warehouse=$("#warehouse").val();
                    // e.status=$("#status").val();
                }
            },
            columns:[
                {data:'DT_RowIndex' ,name:'DT_RowIndex'},
                {data:'thumbnail' ,name:'thumbnail'},
                {data:'name' ,name:'name'},
                {data:'code' ,name:'code'},
                {data:'category_name' ,name:'category_name'},
                {data:'subcategory_name' ,name:'subcategory_name'},
                {data:'brand_name' ,name:'brand_name'},
                {data:'featured' ,name:'featured'},
                {data:'flash_deal_id' ,name:'flash_deal_id'},
                {data:'status' ,name:'status'},
                {data:'action' ,name:'action',orderable:true,searchable:true},

             ]
        });
    });
</script>
{{-- deactive featured --}}
<script type="text/javascript">

  $('body').on("click",".deactive_featured", function(){
      let id = $(this).data('id');
      var url = "{{url('product/not-featured')}}/"+id;
      $.ajax({
          url : url,
          type : 'get',
          success : function(data){
              toastr.success(data);
              table.ajax.reload();
          }
      });
   });
//    active featured
   $('body').on("click",".active_featured", function(){
      let id = $(this).data('id');
      var url = "{{url('product/featured')}}/"+id;
      $.ajax({
          url : url,
          type : 'get',
          success : function(data){
              toastr.success(data);
              table.ajax.reload();
          }
      });
   });
// deactive today deal
   $('body').on("click",".deactive_toady_deal", function(){
      let id = $(this).data('id');
      var url = "{{url('product/not-today_deal')}}/"+id;
      $.ajax({
          url : url,
          type : 'get',
          success : function(data){
              toastr.success(data);
              table.ajax.reload();
          }
      });
   });
// active today deal
   $('body').on("click",".active_toady_deal", function(){
      let id = $(this).data('id');
      var url = "{{url('product/today_deal')}}/"+id;
      $.ajax({
          url : url,
          type : 'get',
          success : function(data){
              toastr.success(data);
              table.ajax.reload();
          }
      });
   });
// deactive status
   $('body').on("click",".deactive_status", function(){
      let id = $(this).data('id');
      var url = "{{url('product/not_status')}}/"+id;
      $.ajax({
          url : url,
          type : 'get',
          success : function(data){
              toastr.success(data);
              table.ajax.reload();
          }
      });
   });
//    active status
   $('body').on("click",".active_status", function(){
      let id = $(this).data('id');
      var url = "{{url('product/status')}}/"+id;
      $.ajax({
          url : url,
          type : 'get',
          success : function(data){
              toastr.success(data);
              table.ajax.reload();
          }
      });
   });

//    submittable class call for every change

$(document).on('change','.submittable', function(){
    $('.ytable').DataTable().ajax.reload();
});

</script>

@endsection