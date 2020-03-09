@extends('backend.layout.template')
@section('page','View Setting')
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
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tables</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Tables</li>
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
                <h5 class="card-header">Basic Table</h5>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <a href="{{route('admin.ta_index')}}" class="btn btn-dark">Kembali</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Nama Bulan</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">

                                    <tr>
                                        <td>Bulan Ke-1</td>
                                        <td>
                                            {{convert_bulan($tahun_ajaran->tahun_ajaran_setting->bulan1)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bulan Ke-2</td>
                                        <td>
                                            {{convert_bulan($tahun_ajaran->tahun_ajaran_setting->bulan2)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bulan Ke-3</td>
                                        <td>
                                            {{convert_bulan($tahun_ajaran->tahun_ajaran_setting->bulan3)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bulan Ke-4</td>
                                        <td>
                                            {{convert_bulan($tahun_ajaran->tahun_ajaran_setting->bulan4)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bulan Ke-5</td>
                                        <td>
                                            {{convert_bulan($tahun_ajaran->tahun_ajaran_setting->bulan5)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bulan Ke-6</td>
                                        <td>
                                            {{convert_bulan($tahun_ajaran->tahun_ajaran_setting->bulan6)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bulan Ke-7</td>
                                        <td>
                                            {{convert_bulan($tahun_ajaran->tahun_ajaran_setting->bulan7)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bulan Ke-8</td>
                                        <td>
                                            {{convert_bulan($tahun_ajaran->tahun_ajaran_setting->bulan8)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bulan Ke-9</td>
                                        <td>
                                            {{convert_bulan($tahun_ajaran->tahun_ajaran_setting->bulan9)}}
                                        </td>
                                    </tr>
                                        
                                    <tr>
                                        <td>Bulan Ke-10</td>
                                        <td>
                                            {{convert_bulan($tahun_ajaran->tahun_ajaran_setting->bulan10)}}
                                        </td>
                                    </tr>
                                        
                                    <tr>
                                        <td>Bulan Ke-11</td>
                                        <td>
                                            {{convert_bulan($tahun_ajaran->tahun_ajaran_setting->bulan11)}}
                                        </td>
                                    </tr>
                                        
                                    <tr>
                                        <td>Bulan Ke-12</td>
                                        <td>
                                            {{convert_bulan($tahun_ajaran->tahun_ajaran_setting->bulan12)}}
                                        </td>
                                    </tr>
                                        
                                </tbody>
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