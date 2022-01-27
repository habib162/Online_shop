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
              <li class="breadcrumb-item active">On Page website</li>
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
                <h3 class="card-title">Website Settings</h3>
              </div>
              <!-- form start -->
              <form role="form" action="{{route('website.setting.update',$setting->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Currency</label>
                    <select name="currency" class="form-control" id="">
                        <option value="৳" {{($setting->currency=='৳') ? 'selected': ""}}>taka(৳)</option>
                        <option value="$"{{($setting->currency=='$') ? 'selected': ""}}>USD($)</option>
                        <option value="₹"{{($setting->currency=='$') ? 'selected': ""}}>Rupee(₹)</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Phone One</label>
                    <input type="text" name="phone_one" value="{{$setting->phone_one}}" class="form-control"  placeholder="Phone One" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Phone Two</label>
                    <input type="text" name="phone_two" value="{{$setting->phone_two}}" class="form-control"  placeholder="Phone Two " required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Main Email</label>
                    <input type="text" name="mail_email" value="{{$setting->mail_email}}" class="form-control"  placeholder="Main Email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Support Email</label>
                    <input name="support_email" class="form-control">{{$setting->support_email}}>
                  </div>
                  <div>
                    <label for="exampleInputPassword1">address</label>
                    <input type="text" name="address" value="{{$setting->address}}" class="form-control"  placeholder="Google Verification">
                  </div>
                  <strong class="text-info">Social link</strong>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Facebook</label>
                    <input type="text" name="facebook" value="{{$setting->facebook}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Twiter</label>
                    <input type="text" name="tweeter" value="{{$setting->tweeter}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">instagram</label>
                    <input type="text" name="instagram" value="{{$setting->instagram}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Linkedin</label>
                    <input type="text" name="linkedin" value="{{$setting->linkedin}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Youtube</label>
                    <input type="text" name="youtube" value="{{$setting->youtube}}" class="form-control">
                  </div>
                 
                  <strong class="text-info">Logo & favicon</strong>
                  <div class="form-group">
                    <label for="exampleInputPassword1"> Main Logo</label>
                    <input type="file" name="logo" class="form-control">
                    <input type="hidden" name="old_logo" value="{{$setting->logo}}">
                </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1"> Favicon</label>
                    <input type="file" name="favicon" class="form-control">
                    <input type="hidden" name="old_favicon" value="{{$setting->favicon}}">
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
