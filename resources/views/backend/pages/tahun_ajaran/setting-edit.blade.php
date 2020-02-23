@extends('backend.layout.template')
@section('page','Edit Pengaturan Tahun Ajaran ' . $tahun_ajaran->concat_tahun)
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
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tahun Ajaran</a></li>
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
                <h5 class="card-header">Basic Table</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                    <form action="{{route('admin.ta_update_setting',$tahun_ajaran->id)}}" method="POST">
                     @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bulan_ke1">Bulan Ke 1</label>
                                        <select  name="bulan_ke1" id="bulan_ke1" class="form-control">
                                            <option disabled>--Pilih Bulan Ke 1--</option>
                                            @foreach (getBulan() as $item)
                                                <option value="{{$item['id']}}"  <?= ($item['id'] == $tahun_ajaran->tahun_ajaran_setting->bulan1) ? 'selected' : ''; ?>>{{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bulan_ke2">Bulan Ke 2</label>
                                        <select  name="bulan_ke2" id="bulan_ke2" class="form-control" readonly>
                                            <option disabled selected>--Pilih Bulan Ke 2--</option>
                                            @foreach (getBulan() as $item)
                                                <option value="{{$item['id']}}" >{{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bulan_ke3">Bulan Ke 3</label>
                                        <select  name="bulan_ke3" id="bulan_ke3" class="form-control" readonly>
                                            <option disabled selected>--Pilih Bulan Ke 1--</option>
                                            @foreach (getBulan() as $item)
                                                <option value="{{$item['id']}}" >{{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bulan_ke4">Bulan Ke 4</label>
                                        <select  name="bulan_ke4" id="bulan_ke4" class="form-control" readonly>
                                            <option disabled selected>--Pilih Bulan Ke 1--</option>
                                            @foreach (getBulan() as $item)
                                                <option value="{{$item['id']}}" >{{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bulan_ke5">Bulan Ke 5</label>
                                        <select  name="bulan_ke5" id="bulan_ke5" class="form-control" readonly>
                                            <option disabled selected>--Pilih Bulan Ke 1--</option>
                                            @foreach (getBulan() as $item)
                                                <option value="{{$item['id']}}" >{{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bulan_ke6">Bulan Ke 6</label>
                                        <select  name="bulan_ke6" id="bulan_ke6" class="form-control" readonly>
                                            <option disabled selected>--Pilih Bulan Ke 1--</option>
                                            @foreach (getBulan() as $item)
                                                <option value="{{$item['id']}}" >{{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bulan_ke7">Bulan Ke 7</label>
                                        <select  name="bulan_ke7" id="bulan_ke7" class="form-control" readonly>
                                            <option disabled selected>--Pilih Bulan Ke 1--</option>
                                            @foreach (getBulan() as $item)
                                                <option value="{{$item['id']}}" >{{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bulan_ke8">Bulan Ke 8</label>
                                        <select  name="bulan_ke8" id="bulan_ke8" class="form-control" readonly>
                                            <option disabled selected>--Pilih Bulan Ke 1--</option>
                                            @foreach (getBulan() as $item)
                                                <option value="{{$item['id']}}" >{{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bulan_ke9">Bulan Ke 9</label>
                                        <select  name="bulan_ke9" id="bulan_ke9" class="form-control" readonly>
                                            <option disabled selected>--Pilih Bulan Ke 1--</option>
                                            @foreach (getBulan() as $item)
                                                <option value="{{$item['id']}}" >{{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bulan_ke10">Bulan Ke 10</label>
                                        <select  name="bulan_ke10" id="bulan_ke10" class="form-control" readonly>
                                            <option disabled selected>--Pilih Bulan Ke 1--</option>
                                            @foreach (getBulan() as $item)
                                                <option value="{{$item['id']}}" >{{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bulan_ke11">Bulan Ke 11</label>
                                        <select  name="bulan_ke11" id="bulan_ke11" class="form-control" readonly>
                                            <option disabled selected>--Pilih Bulan Ke 1--</option>
                                            @foreach (getBulan() as $item)
                                                <option value="{{$item['id']}}" >{{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bulan_ke12">Bulan Ke 12</label>
                                        <select  name="bulan_ke12" id="bulan_ke12" class="form-control" readonly>
                                            <option disabled selected>--Pilih Bulan Ke 1--</option>
                                            @foreach (getBulan() as $item)
                                                <option value="{{$item['id']}}" >{{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" name="submit_permanent" id="submit_permanent" value="Simpan Permanen" class="btn btn-success float-right ml-1">
                                    <input type="submit" name="submit" id="submit" value="Simpan" class="btn btn-primary float-right">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
           cetak_form();
            $(document).on('change','#bulan_ke1',function(){
                loop = $(this).val();
                const value_bulan1 = $(this).val();
                var lebih = 1;
                for (let i = 1; i < 13; i++) {
                    if(loop > 12){
                        $(`#bulan_ke${i}`).val(lebih);
                        lebih++;
                    }else{
                        $(`#bulan_ke${i}`).val(loop ++);
                    }
                    
                }
            });
            function cetak_form(){
                loopc = $('#bulan_ke1').val();
                const value_bulan1 = $('#bulan_ke1').val();
                var lebihc = 1;
                for (let i = 1; i < 13; i++) {
                    if(loopc > 12){
                        $(`#bulan_ke${i}`).val(lebihc);
                        lebihc++;
                    }else{
                        $(`#bulan_ke${i}`).val(loopc ++);
                    }
                    
                }
            }
        });
    </script>
@endpush