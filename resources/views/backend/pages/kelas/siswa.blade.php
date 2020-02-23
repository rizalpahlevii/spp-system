@extends('backend.layout.template')
@section('page','Siswa Kelas ' . $data->nama_kelas)    
@section('content')  
<div class="container-fluid  dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Data Siswa Kelas {{$data->nama_kelas}}</h2>
                <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">E-SPP</a></li>
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Kelas</a></li>
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
                <h5 class="card-header">@yield('page')</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{route('admin.kelas_tambah_siswa',request()->segment(3))}}" class="btn btn-primary mb-2">Tambah Siswa</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            @if (Session::has('message'))
                                <div class="alert alert-{{Session::get('message_type')}}" role="alert">
                                    {{Session::get('message')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>NIS</th>
                                    <th>NISN</th>
                                    <th>Kelas</th>
                                    <th>Telp</th>
                                    <th>Kompetensi Keahlian</th>
                                    <th>SPP</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->siswa as $row)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->nis}}</td>
                                        <td>{{$row->nisn}}</td>
                                        <td>{{$data->nama_kelas}}</td>
                                        <td>{{$row->no_telp}}</td>
                                        <td>{{$data->kompetensi_keahlian}}</td>
                                        <td>{{$row->spp->nominal}}</td>
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