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
              <li class="breadcrumb-item active">SMTP Mail</li>
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
                <h3 class="card-title">SMTP Settings</h3>
              </div>
              <!-- form start -->
              <form role="form" action="{{route('smtp.setting.update',$smtp->id)}}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Mail Mailer</label>
                    <input type="text" name="mailer" value="{{$smtp->mailer}}" class="form-control"  placeholder="Mail Mailer">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Mail Host</label>
                    <input type="text" name="host" value="{{$smtp->host}}" class="form-control"  placeholder="Mail Host">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Mail Port</label>
                    <input type="text" name="port" value="{{$smtp->port}}" class="form-control"  placeholder="Mail Port">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Mail Username</label>
                    <input type="text" name="user_name" value="{{$smtp->user_name}}" class="form-control"  placeholder="Mail Username">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Mail Password</label>
                    <input type="text" name="password" value="{{$smtp->password}}" class="form-control"  placeholder="Mail Password">
                  </div>

                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update </button>
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
