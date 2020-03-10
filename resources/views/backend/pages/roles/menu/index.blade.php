@extends('backend.layout.template')
@section('page','Menu')    
@section('content')  
<div class="container-fluid  dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Menu</h2>
                <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">E-SPP</a></li>
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Roles</a></li>
                            <li class="breadcrumb-item active" aria-current="page">SPP</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- ============================================================== -->
        <!-- basic table  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Menu</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            @if (Session::has('message'))
                                <div class="alert alert-{{Session::get('message_type')}}" role="alert">
                                {{Session::get('message')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    {{-- <a href="{{route('admin.role_menu_create')}}"  class="btn btn-primary mb-2 btn-add">Tambah</a> --}}
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Icon</th>
                                    <th>URI</th>
                                    <th>Route</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menus as $row)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->title}}</td>
                                        <td>{{$row->icon}} / <i class="{{$row->icon}}"></i></td>
                                        <td>{{$row->uri}}</td>
                                        <td>{{$row->route}}</td>
                                        <td>
                                            <span class="badge badge-{{$row->is_active=="yes"?"success":"danger"}}">{{$row->is_active == "yes" ? "Aktif":"Nonaktif"}}</span>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.role_menu_show',$row->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end basic table  -->
        <!-- ============================================================== -->
    </div>
</div>
@endsection