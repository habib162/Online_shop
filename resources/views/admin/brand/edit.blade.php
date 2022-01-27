
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<form action="{{route('brand.update')}}"method="Post" enctype="multipart/form-data" id="add-form">
    @csrf
    <div class="modal-body">

        <div class="form-group">
            <label for="brand_name">Brand Name</label>
            <input type="text" class="form-control" name="brand_name" value="{{ $data->brand_name }}" required>
           <small id="emailHelp" class="form-text text-muted">This is your main Brand</small>
        </div>
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="form-group">
            <label for="brand_name">Brand Logo</label>
            <input type="file" class="form-control dropify"data-height="140" id="input-file-now" name="brand_logo">
            <input type="hidden" name="old_logo" value="{{$data->brand_logo}}">
           <small id="emailHelp" class="form-text text-muted">This is your Brand Logo</small>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"><span class="d-none">Loading...</span> Submit</button>
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
