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
              <li class="breadcrumb-item active">Page create</li>
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
                <h3 class="card-title">Create a new page</h3>
              </div>
              <!-- form start -->
              <form role="form" action="{{route('page.store')}}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputPassword1">page position</label>
                    <select name="page_position" class="form-control">
                        <option value="">Line One</option>
                        <option value="">Line two</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">page Name</label>
                    <input type="text" name="page_name" class="form-control" id="exampleInputPassword1" placeholder="Page Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword2">page title</label>
                    <input type="text" class="form-control" name="page_title" id="exampleInputPassword2"  placeholder="Page Title">
            
                  </div>
                   
                  <div class="form-group">
                    <label for="exampleInputPassword3">page description</label>
                    <textarea name="page_description" class="form-control textarea"></textarea>                   
                    <small>  This data will show on your webpage</small>
                </div>
                  
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Create Page</button>
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
