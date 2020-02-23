@extends('backend.layout.template')
@section('page','Detail Siswa '.$siswa->name .' / ' .$siswa->kelas->nama_kelas)    
@section('content')  
<div class="container-fluid  dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">@yield('page')</h2>
                <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">E-SPP</a></li>
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Siswa</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@yield('page')</li>
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
                    <a href="{{route('admin.siswa_index')}}" class="btn btn-dark mb-2">Kembali</a>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th>Nama</th>
                                    <td>:</td>
                                    <td>{{$siswa->name}}</td>
                                </tr>
                                <tr>
                                    <th>NIS</th>
                                    <td>:</td>
                                    <td>{{$siswa->nis}}</td>
                                </tr>
                                <tr>
                                    <th>NISN</th>
                                    <td>:</td>
                                    <td>{{$siswa->nisn}}</td>
                                </tr>
                                <tr>
                                    <th>Kelas</th>
                                    <td>:</td>
                                    <td>{{$siswa->kelas->nama_kelas}}</td>
                                </tr>
                                <tr>
                                    <th>Telephon</th>
                                    <td>:</td>
                                    <td>{{$siswa->no_telp}}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>:</td>
                                    <td>{{$siswa->jenis_kelamin}}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>:</td>
                                    <td>{{$siswa->alamat}}</td>
                                </tr>
                                <tr>
                                    <th>SPP</th>
                                    <td>:</td>
                                    <td>{{rupiah($siswa->spp->nominal)}}</td>
                                </tr>
                            </table>
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