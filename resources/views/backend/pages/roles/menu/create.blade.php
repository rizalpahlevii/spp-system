@extends('backend.layout.template')
@section('page','Tambah Menu')    
@section('content')  
<div class="container-fluid  dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Tambah Menu</h2>
                <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">E-SPP</a></li>
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Menu</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Menu</li>
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
                <h5 class="card-header">Tambah Petugas</h5>
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
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{$url}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ isset($menu) ? $menu->title : ''}}">
                                            @error('title')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="icon">Icon</label>
                                            <input type="text" name="icon" id="icon" class="form-control @error('icon') is-invalid @enderror" value="{{isset($menu) ? $menu->icon : ''}}">
                                            @error('icon')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input" placeholder="Menu" value="yes" 
                                            @isset($menu)
                                                @if($menu->is_active == "yes")
                                                    checked
                                                @endif
                                            @endisset
                                        >
                                        <label for="is_active" class="form-check-label">Active?</label>
                                    </div>              
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
                                        <a href="{{route('admin.role_menu')}}" class="btn btn-dark">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
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
@push('script')
<script>
    $(document).ready(function(){
        $('.table').dataTable();
    });
</script>
@endpush