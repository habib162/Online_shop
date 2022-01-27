@extends('layouts.admin')

@section('admin_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Coupon</h1>
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
                            <h3 class="card-title">Coupon list here:</h3>   
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table  class="ytable table table-bordered table-striped table-sm">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Coupon Code</th>
                                <th>Coupon Amount</th>
                                <th> Valid Date</th>
                                <th> Coupon Status</th>
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
          <h5 class="modal-title" id="exampleModalLabel">Coupon</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>        
        </div>
        <form action="{{route('coupon.store')}}"method="post"class="add_form">
            @csrf
            <div class="modal-body">
              <div class="form-group">                    
                <label for="coupon_code">Coupon Code</label>
                    <input type="text" class="form-control" name="coupon_code" required>
                   <small id="emailHelp" class="form-text text-muted">This is your Sub category</small>
                </div>
                <div class="form-group">
                    <label for="coupon_type">Coupon Type</label>
                    <select name="type" class="form-control"id="" required>
                        <option value="1">Fixed</option>
                        <option value="2">percentage(%)</option>
                    </select>    
                </div>
                <div class="form-group">
                    <label for="coupon_amount">Coupon Amount</label>
                    <input type="text" class="form-control" name="coupon_amount" required>
                </div>
                <div class="form-group">
                    <label for="valid_date">Valid date</label>
                    <input type="date" class="form-control" name="valid_date" required>
                </div>
            </div>
            <div class="form-group">
                <label for="status">Coupon Status</label>
                <select name="status" class="form-control"id="" required>
                    <option value="active">active</option>
                    <option value="deactive">deactive</option>
                </select>    
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Coupon</h5>
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
    $.get("coupon/edit/"+childcat_id, function(data){
       $("#modal_body").html(data);
    });
 });
</script>


<script type="text/javascript">
  
    $(function childcategory(){
         table1=$('.ytable').DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{route('coupon.index')}}",
            columns:[
                {data:'DT_RowIndex' ,name:'DT_RowIndex'},
                {data:'coupon_code' ,name:'coupon_code'},
                {data:'coupon_amount' ,name:'coupon_amount'},
                {data:'valid_date' ,name:'valid_date'},
                {data:'status' ,name:'status'},
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