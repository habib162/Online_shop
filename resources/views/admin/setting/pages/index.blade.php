@extends('layouts.admin')

@section('admin_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> All Pages</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="{{route('create.page')}}"  class="btn btn-primary">+ Add New</a> 
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
                            <h3 class="card-title">ALl Pages list here:</h3>   
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped table-sm">
                            <thead>
                            <tr>
                            <th>SL</th>
                            <th>page Name</th>
                            <th>page Title</th>
                            <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ( $page as $key=>$row ) 
                            <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{$row->page_name}}</td>
                            <td>{{$row->page_title}}</td>
                            <td>
                                <a href="{{route('page.edit',$row->id)}}" class=" btn btn-info btn-sm " ><i class="fas fa-edit"></i></a>
                                <a href="{{route('page.delete',$row->id)}}" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>
                                {{-- <a href="" class="btn btn-success btn-sm">view</a> --}}
                            </td>
                            </tr>
                            @endforeach
                          </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>



@endsection