<form action="{{route('pickup_point.update')}}"method="post"class="edit_form">
    @csrf
    <div class="modal-body">
      <div class="form-group">                    
        <label for="pickup_point_name">Pickup point name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="pickup_point_name"value={{$data->pickup_point_name}} required>                
            <input type="hidden" name="id" value="{{$data->id}}">
        </div>
        
        <div class="form-group">
            <label for="pickup_point_address">Address<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="pickup_point_address"value={{$data->pickup_point_address}}  required>
        </div>
        <div class="form-group">
            <label for="pickup_point_phone">Phone<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="pickup_point_phone"value={{$data->pickup_point_phone}}  required>
        </div>
        <div class="form-group">
            <label for="pickup_point_phone_two">Another Phone</label>
            <input type="text" class="form-control" name="pickup_point_phone_two"value={{$data->pickup_point_phone_two}} >
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-danger modal_close" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> update</button>
    </div>
</form>

<script>
    // update coupon with ajax call

    $('.edit_form').submit(function(e){
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
                  $('.edit_form')[0].reset();
                  $('#editmodal').modal('hide');
                  table1.ajax.reload();
              }
       });
  });
</script>