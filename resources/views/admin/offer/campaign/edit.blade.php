
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<form action="{{route('campaign.update')}}"method="Post" enctype="multipart/form-data" id="add-form">
    @csrf
    <div class="modal-body">

        <div class="form-group">
            <label for="title">Campaign title</label>
            <input type="text" class="form-control" name="title" value="{{ $data->title }}" required>
           <small id="emailHelp" class="form-text text-muted">This is Campaign Title/name</small>
        </div>
        <input type="hidden" name="id" value="{{ $data->id }}">

        <div class="row">
            <div class="col-lg-6">
                <label for="start_date">Start Date <span class="text-danger">*</span> </label>
                <input type="date" class="form-control"id="input-file-now" name="start_date"value="{{ $data->start_date }}" required>
            </div>
            <div class="col-lg-6">
                <label for="end_date">End Date<span class="text-danger">*</span></label>
            <input type="date" class="form-control "id="input-file-now" name="end_date"value="{{ $data->end_date }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <label for="start_date">Status<span class="text-danger">*</span> </label>
                <select class="form-control" name="status">
                    <option value="1"@if($data->status==1) selected="" @endif>Active</option>
                    <option value="0"@if($data->status==0) selected="" @endif>Deactive</option>
                </select>
            </div>
            <div class="col-lg-6">
                <label for="discount">Discount (%)<span class="text-danger">*</span></label>
            <input type="number" class="form-control "id="input-file-now" name="discount"value="{{ $data->discount }}" required>
            <small id="emailHelp" class="form-text text-danger">Discount percentage are apply for all product selling price</small>
            </div>
        </div>
        <div class="form-group">
            <label for="brand_name">Campaign Image</label>
            <input type="file" class="form-control dropify"data-height="140" id="input-file-now" name="image">
            <input type="hidden" name="old_image" value="{{$data->image}}">
           <small id="emailHelp" class="form-text text-muted">This is your Campaign Image</small>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"><span class="d-none">Loading...</span> Update</button>
    </div>
</form>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
