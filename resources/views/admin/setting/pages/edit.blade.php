@extends('layouts.admin')

@section('admin_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">Page Update</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update page</h3>
              </div>
              <!-- form start -->
              <form role="form" action="{{route('page.update',$page->id)}}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputPassword1">page position</label>
                    <select name="page_position" class="form-control">
                        <option value="1"@if ($page->page_position==1)
                            selected
                        @endif>Line One</option>
                        <option value="2"{{($page->page_position==2) ?"selected" : "" }}>Line two</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">page Name</label>
                    <input type="text" name="page_name" class="form-control" id="exampleInputPassword1" value="{{$page->page_name}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword2">page title</label>
                    <input type="text" class="form-control" name="page_title" id="exampleInputPassword2"  value="{{($page->page_title)}}">
            
                  </div>
                   
                  <div class="form-group">
                    <label for="exampleInputPassword3">page description</label>
                    <textarea name="page_description" class="form-control textarea">{{$page->page_description}}</textarea>                   
                    <small>  This data will show on your webpage</small>
                </div>
                  
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update Page</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
