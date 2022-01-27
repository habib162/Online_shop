<form action="{{route('coupon.update')}}"method="post"class="edit_form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="coupon_code">Coupon Code</label>
            <input type="text" class="form-control" name="coupon_code"value="{{$data->coupon_code}}" required>
            <input type="hidden"name="id" value="{{$data->id}}">
        </div>
        <div class="form-group">
            <label for="coupon_type">Coupon Type</label>
            <select name="type" class="form-control" required>
                <option value="1"@if ($data->type==1)
                    selected
                @endif>Fixed</option>
                <option value="2"@if ($data->type==2)
                    selected
                @endif>percentage(%)</option>
            </select>    
        </div>
        <div class="form-group">
            <label for="coupon_amount">Coupon Amount</label>
            <input type="text" class="form-control" name="coupon_amount"value="{{$data->coupon_amount}}" required>
        </div>
        <div class="form-group">
            <label for="valid_date">Valid date</label>
            <input type="date" class="form-control" name="valid_date" value="{{$data->valid_date}}" required>
        </div>
    </div>
    <div class="form-group">
        <label for="status">Coupon Status</label>
        <select name="status" class="form-control"id="" required>
            <option value="active"@if ($data->type=='active')
                selected
            @endif>active</option>
            <option value="deactive"@if ($data->type=='deactive')
                selected
            @endif>deactive</option>
        </select>    
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger modal_close" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
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