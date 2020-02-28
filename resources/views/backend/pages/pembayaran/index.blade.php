@extends('backend.layout.template')
@section('page','Pembayaran SPP')    
@section('content')  
<div class="container-fluid  dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Data Pembayaran SPP</h2>
                <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">E-SPP</a></li>
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pembayaran SPP</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Pembayaran SPP</li>
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
                <h5 class="card-header">Data Pembayaran SPP</h5>
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
                    <a href="{{route('admin.pembayaran_create')}}" class="btn btn-primary mb-2 btn-add"><i class="fas fa-plus"></i></a>
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <select name="kelas" id="kelas" class="form-control">
                                        <option value="all" {{set_selected_option_kelas('all')}}>Semua Kelas</option>
                                        @foreach ($kelas as $rowk)
                                            <option value="{{$rowk->id}}" {{set_selected_option_kelas($rowk->id)}}>{{$rowk->nama_kelas}} - {{$rowk->kompetensi_keahlian}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ta">Tahun Ajaran</label>
                                    <select name="ta" id="ta" class="form-control">
                                        <option value="all" {{set_selected_option_ta('all')}}>Semua Tahun Ajaran</option>
                                        @foreach ($tahun_ajaran as $rowt)
                                            <option value="{{$rowt->id}}" {{set_selected_option_ta($rowt->id)}}>{{$rowt->concat_tahun}}</option>
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
                                    <th>Nama</th>
                                    <th>NIS</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Kelas</th>
                                    <th>SPP Bulan</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pembayaran as $row)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->siswa->name}}</td>
                                        <td>{{$row->siswa->nis}}</td>
                                        <td>{{$row->tgl_bayar}}</td>
                                        <td>{{$row->siswa->kelas->nama_kelas}}</td>
                                        <td>{{getMonthSetting($row->tahun_ajaran->id,$row->bulan_bayar)}}</td>
                                        <td>{{$row->tahun_ajaran->concat_tahun}}</td>
                                        <td>
                                            <a href="#" class="btn btn-success"><i class="fas fa-list"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{$pembayaran->links()}}
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