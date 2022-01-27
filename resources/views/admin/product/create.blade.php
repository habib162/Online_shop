@extends('layouts.admin');
@section('admin_content');
{{-- <script type="text/javascript" src="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<style type="text/css">
    .bootstrap-tagsinput .tag{
        background: #428bca;
        border: 1px solid white;
        padding: 1px 6px;
        padding-left: 2px;
        padding-right: 2px;
        color: white;
        border-radius: 4px;
    }
</style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>New Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">New Product</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    @if ($errors->any())
    <div class="alert alert-damger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
      
    @endif

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       
        <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
          <!-- left column -->
          @csrf
          <div class="row">
           <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add new product</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="form-group col-lg-6">
                    <label for="name">Product Name <span class="text-danger">*</span></label>
                    <input type="text"name="name" class="form-control" value="{{old('name')}}" required>
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="code">Product Code <span class="text-danger">*</span></label>
                    <input type="text"name="code"value="{{old('code')}}" class="form-control"required>
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="exampleInputEmail1">Category/Subcategory <span class="text-danger">*</span></label>
                    <select class="form-control" name="subcategory_id" id="subcategory_id" required>
                        <option disabled selected>==chose category==</option>
                        @foreach ($category as $row)
                            @php
                                $subcategory=DB::table('subcategories')->where('category_id',$row->id)->get();
                            @endphp
                            <option style="color:#428bca;"disabled>{{$row->category_name}}</option>
                            @foreach ($subcategory as $row )
                                <option value="{{$row->id}}">--{{$row->subcategory_name}}</option>
                            @endforeach
                        @endforeach
                        
                    </select>
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="exampleInputEmail1">Childcategory <span class="text-danger">*</span></label>
                    <select class="form-control" name="childcategory_id" id="childcategory_id">
                    </select>
                  </div>
                  <div class="row">
                     <div class="form-group col-lg-6">
                        <label for="exampleInputEmail1">Brand <span class="text-danger">*</span></label>
                        <select class="form-control" name="brand_id" id="">
                            @foreach ($brand as $row)
                                <option value="{{$row->id}}">{{$row->brand_name}}</option>
                            @endforeach
                            
                        </select>
                      </div>
                      <div class="form-group col-lg-6">
                        <label for="exampleInputEmail1">Pickup Point <span class="text-danger">*</span></label>
                        <select class="form-control" name="pickup_point_id" id="">
                            @foreach ($pickup_point as $row)
                                <option value="{{$row->id}}">{{$row->pickup_point_name}}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="form-group col-lg-6">
                        <label for="exampleInputEmail1">Unit <span class="text-danger">*</span></label>
                       <input type="text" class="form-control" name="unit"value="{{old('unit')}}" required>
                      </div>
                      <div class="form-group col-lg-6">
                        <label for="exampleInputEmail1">Tags</span></label>
                        <input class="form-control" name="tag"value="{{old('tag')}}" data-role="tagsinput">
                      </div>
                  </div> 
                  <div class="row">
                    <div class="form-group col-lg-4">
                        <label for="exampleInputEmail1">Purchase Price</span></label>
                        <input type="text" class="form-control" name="purchase_price"value="{{old('purchase_price')}}">
                      </div>
                      <div class="form-group col-lg-4">
                        <label for="exampleInputEmail1">Selling Price <span class="text-danger">*</span></label>
                        <input type="text" class="form-control"name="selling_price"value="{{old('selling_price')}}" required>
                      </div>
                      <div class="form-group col-lg-4">
                        <label for="exampleInputEmail1">Discount Price</span></label>
                        <input type="text" class="form-control"name="discount_price"value="{{old('discount_price')}}" >
                      </div>
                  </div>
                   <div class="row">
                     <div class="form-group col-lg-6">
                        <label for="exampleInputEmail1">WareHouse <span class="text-danger">*</span></label>
                        <select class="form-control" name="warehouse" id="">
                            @foreach ($warehouse as $row )
                                <option value="{{$row->warehouse_name}}">{{$row->warehouse_name}}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="form-group col-lg-6">
                        <label for="exampleInputEmail1">Stock</span></label>
                        <input class="form-control" name="stock_quantity"value="{{old('stock_quantity')}}" id="">
                      </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="exampleInputEmail1">Color</span></label>
                            <input type="text" class="form-control"data-role="tagsinput"name="color"{{old('color')}}>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="exampleInputEmail1">Size</span></label>
                            <input type="text" class="form-control"data-role="tagsinput"name="size"value="{{old('size')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Product Details</label>
                            <textarea name="description" class="form-control textarea" value="{{old('description')}}"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Video Embed Code</label>
                            <input name="video" class="form-control"value="{{old('video')}}" placeholder="only Code after embeded word" >
                            <small class="text-danger">only Code after embeded word</small>
                        </div>
                    </div>
                </div>
                
                <!-- /.card-body -->
            </div>
          </div>

          <!--/.col (left) --> 
          <!-- right column -->
          <div class="col-md-4">
            <!-- Form Element sizes -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Main Thumbnail</h3>
               </div>
              <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Main Thumbnail <span class="text-danger">*</span></label>
                    <br>
                    <input class="form-control" type="file" name="thumbnail" required="" accept="image/*"class="dropify">
                    <br>
                </div>
                <div class="">
                    <table class="table table-bordered"id="dynamic_field">
                        <div class="card-hearder">
                            <h4 class="'card-title">More Images ( Click Add for more Image)</h4>
                        </div>
                        <tr>
                            <td>
                                <input type="file" accept="image/*" name="images[]" class="form-control name_list">
                            </td>
                            <td>
                                <button type="button" name="add" id="add" class="btn btn-success">Add</button>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="card p-4">
                    <h6 >Featured Product</h6>
                    <input type="checkbox" name="featured"value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                </div>
                <div class="card p-4">
                    <h6 >Today Deal</h6>
                    <input type="checkbox" name="flash_deal_id"value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                </div>
                <div class="card p-4">
                  <h6 >Slider Product</h6>
                  <input type="checkbox" name="product_slider"value="1"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                </div>
                <div class="card p-4">
                  <h6 >Trendy Product</h6>
                  <input type="checkbox" name="trendy_product"value="1"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                </div>
                <div class="card p-4">
                    <h6 >Status</h6>
                    <input type="checkbox" name="status"value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                </div>
               
              </div> 
              <!-- /.card-body -->
             </div>
            </div>
            <button class="btn btn-info ml-2"type="submit">Submit</button>
                <!-- /.card -->
          </div>
          
        </form>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
{{-- <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="{{asset('public/backend')}}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" integrity="sha512-9UR1ynHntZdqHnwXKTaOm1s6V9fExqejKvg5XMawEMToW4sSw+3jtLrYfZPijvnwnnE8Uol1O9BcAskoxgec+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
    $('.dropify').dropify();
    $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state',$(this).prop('checked'));
    });

    $(document).ready(function(){
        var postURL = "<?php echo url('addmore'); ?>";
        var i=1;

        $('#add').click(function(){
            i++;
            $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="file" accept="image/*" name="images[]" class="form-control name_list"/></td><td><button type="button" name="remove" id="btn_remove '+i+'" class="btn btn-danger ">✕</button></td></tr> ');
     
        });

        $(document).on('click', '#btn_remove', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });
    });
// ajax request send for collect childcategory
$("#subcategory_id").change(function(){
    var id = $(this).val();
    $.ajax({
        url: "{{ url("/get_childcategory/") }}"+id,
        type: 'get',
        success: function(data){
            $('select[name="childcategory_id"]').empty();
                $.each(data,function(key,data){
                    $('select[name="childcategory_id"]').append('<option value="'+data.id+'"> '+data.childcategory_name+'</option>');
                });
        }
    });
});
 
</script>

@endsection