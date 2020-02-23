@extends('backend.layout.template')
@section('page','Siswa')    
@section('content')  
<div class="container-fluid  dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Data Siswa</h2>
                <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">E-SPP</a></li>
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Siswa</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
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
                <h5 class="card-header">Data Siswa</h5>
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
                    <a href="{{route('admin.siswa_create')}}" class="btn btn-primary mb-2 btn-add">Tambah Siswa</a>
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <select name="kelas" id="kelas" class="form-control">
                                        <option value="all" {{set_selected_option_kelas('all')}}>Semua Siswa</option>
                                        @foreach ($kelas as $rowk)
                                            <option value="{{$rowk->id}}" {{set_selected_option_kelas($rowk->id)}}>{{$rowk->nama_kelas}} - {{$rowk->kompetensi_keahlian}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-success mt-4">Filter</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Telp</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa as $row)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->nis}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->kelas->nama_kelas}}</td>
                                        <td>{{$row->no_telp}}</td>
                                        <td>
                                            <a href="{{route('admin.siswa_detail',$row->id)}}" class="btn btn-success"><i class="fas fa-list"></i></a>
                                            <a href="{{route('admin.siswa_show',$row->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                            <a href="{{route('admin.siswa_delete',$row->id)}}" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus siswa ini ?')"><i class="fas fa-trash-alt"></i></a>
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
@push('script')
@endpush