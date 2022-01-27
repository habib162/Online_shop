
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<form action="{{route('category.update')}}"method="Post" enctype="multipart/form-data" id="add-form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="category_name">Category Name</label>
            <input type="text" class="form-control" id="e_category_name" name="category_name"value="{{ $data->category_name }}" required>
           <small id="emailHelp" class="form-text text-muted">This is your main category</small>
        </div>
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="form-group">
          <label for="home_page">Home Page</label>
          <select name="home_page" class="form-control">
            <option value="1" @if ($data->home_page==1) selected @endif>yes</option>
            <option value="0" @if ($data->home_page==0) selected @endif>no</option>
          </select>
         <small id="emailHelp" class="form-text text-muted">This is just for showing home page</small>
      </div>
      <div class="form-group">
        <label for="Icon">Icon</label>
        <input type="file" class="form-control dropify"data-height="140" id="input-file-now" name="icon">
            <input type="hidden" name="old_icon" value="{{$data->icon}}">
       <small id="emailHelp" class="form-text text-muted">This is your Category Icon</small>
    </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
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
