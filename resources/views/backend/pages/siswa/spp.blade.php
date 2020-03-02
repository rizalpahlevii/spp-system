@extends('backend.layout.template')
@section('page','SPP Siswa '.$siswa->name .' / ' .$siswa->kelas->nama_kelas)    
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
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="mk">Kelas</label>
                                    <select name="mk" id="mk" class="form-control">
                                        <option disabled selected>-- Pilih Kelas --</option>
                                        @foreach ($master_kelas as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary mt-4">Filter</button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-7">
                            <table class="table">
                                <tr>
                                    <th>Kelas</th>
                                    <td>:</td>
                                    <td>{{ $master_kelas_view->name }}</td>
                                </tr>
                                <tr>
                                    <th>Kompetensi Keahlian</th>
                                    <td>:</td>
                                    <td>{{$siswa->kelas->kompetensi_keahlian}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th colspan="2">#</th>
                                    <th>Nama Bulan</th>
                                    <th>Status</th>
                                </tr>
                                @foreach ($siswa->pembayaran as $key=>$item)
                                    <tr>
                                        <th>Bulan {{$key+1}}</th>
                                        <td>:</td>
                                        <td>{{getMonthSetting($item->tahun_ajaran_id,$item->bulan_bayar)}}</td>
                                        <td>
                                            <span class="badge badge-success">Sudah Bayar</span>
                                        </td>
                                    </tr>
                                @endforeach
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