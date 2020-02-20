@extends('admin.layout.template')
@section('page','Setting '.$tahun_ajaran->concat_tahun)
@section('content')
<div class="container-fluid">
    <!-- OVERVIEW -->
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Setting Tahun Ajaran {{$tahun_ajaran->concat_tahun}}</h3>
        </div>
        <div class="panel-body">
            <div class="row mb-2">
                <div class="col-md-6">
                    <a href="{{route('admin.ta_index')}}" class="btn btn-success">Kembali</a>
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
@endsection