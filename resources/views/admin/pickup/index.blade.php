@extends('layouts.admin')

@section('admin_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pickpoint</h1>
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
                            <h3 class="card-title">pickup point list here:</h3>   
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table  class="ytable table table-bordered table-striped table-sm">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>pickup point</th>
                                <th> address</th>
                                <th>  Phone</th>
                                <th>  Another Phone</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            </tr>
                          </table>

                          <form class="deleted_form" action="" method="delete">
                            @csrf @method('DELETE')
                          </form>
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
          <h5 class="modal-title" id="exampleModalLabel">Add Pickup Point</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>        
        </div>
        <form action="{{route('pickup_point.store')}}"method="post"class="add_form">
            @csrf
            <div class="modal-body">
              <div class="form-group">                    
                <label for="pickup_point_name">Pickup point name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="pickup_point_name" required>                
                </div>
                
                <div class="form-group">
                    <label for="pickup_point_address">Address<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="pickup_point_address" required>
                </div>
                <div class="form-group">
                    <label for="pickup_point_phone">Phone<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="pickup_point_phone" required>
                </div>
                <div class="form-group">
                    <label for="pickup_point_phone_two">Another Phone</label>
                    <input type="text" class="form-control" name="pickup_point_phone_two">
                </div>
            </div>
 
            <div class="modal-footer">
                <button type="button" class="btn btn-danger modal_close" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><span class="loading d-none">Loading...</span> Submit</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Pickup Point</h5>
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


 <script>
    // edit form-submit
   $('body').on("click","#editcoupon", function(){
      let childcat_id = $(this).data('id');
      $.get("pickup_point/edit/"+childcat_id, function(data){
         $("#modal_body").html(data);
      });
   });
  </script>
  
  


<script type="text/javascript">
  
    $(function childcategory(){
         table1=$('.ytable').DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{route('pickup_point.index')}}",
            columns:[
                {data:'DT_RowIndex' ,name:'DT_RowIndex'},
                {data:'pickup_point_name' ,name:'pickup_point_name'},
                {data:'pickup_point_address' ,name:'pickup_point_address'},
                {data:'pickup_point_phone' ,name:'pickup_point_phone'},
                {data:'pickup_point_phone_two' ,name:'pickup_point_phone_two'},
                {data:'action' ,name:'action',orderable:true,searchable:true},

             ]
        });
    });
</script>

<script>

// store coupon with ajax call
$('.add_form').submit(function(e){
            e.preventDefault();
            $('.loading').removeClass('d-none');
            var url = $(this).attr('action');
            var request = $(this).serialize();
            $.ajax({
                url:url,
                type: 'Post',
                async: false,
                data:request,
                success:function(data){
                    toastr.success(data);
                    $('.loading').addClass('d-none');
                    $('.add_form')[0].reset();
                    $('#addmodal').modal('hide');
                    table1.ajax.reload();
                }
         });
    });

  

$(document).ready(function(){

    $(document).on('click','#delete_coupon',function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        $(".deleted_form").attr('action',url);
        swal({
            title: "are you sure?",
            text : "Once deleted, you will not be able to recover thsi imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete)=>{
            if (willDelete) {
                $(".deleted_form").submit();
            }else{
                swal("your data safe!");
            }
          });
       });
    
        // data passed through here
        
        $('.deleted_form').submit(function(e){
            e.preventDefault();
            var url = $(this).attr('action');
            var request = $(this).serialize();
            $.ajax({
                url:url,
                type: 'Post',
                async: false,
                data:request,
                success:function(data){
                    toastr.success(data);
                    $('.deleted_form')[0].reset();
                    table1.ajax.reload();
                }
         });
    });
});


</script>

@endsection