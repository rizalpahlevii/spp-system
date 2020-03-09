@extends('backend.layout.template')
@section('page','Tambah SPP '.$siswa->name . ' | ' .$siswa->kelas->nama_kelas)    
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
                <h5 class="card-header">Transaksi SPP | {{$siswa->kelas->tahun_ajaran->concat_tahun}}</h5>
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="nominal" id="nominal" value="{{$siswa->spp->nominal}}">
                        @foreach ($viewSetting as $key=>$item)
                        @php
                            $key++;
                        @endphp
                            <div class="col-md-3 mb-3">
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">{{$item['value_name']}}</label>
                                    <div class="col-12 col-sm-8 col-lg-6 pt-1">
                                        <div class="switch-button switch-button-success">
                                            <input type="checkbox" {{$item['checked'] ? 'checked=""  disabled':''}} name="{{$item['value_name']}}" id="option{{$key}}" data-kode="{{$key}}" data-limit="{{$limit}}"><span>
                                        <label for="option{{$key}}"></label></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="total">Total Bayar</label>
                                <input type="number" name="total" id="total" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-3 float-right">
                            <input type="submit" name="submit" value="Simpan" class="btn btn-primary mt-4">
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
        $(document).on('click',':checkbox',function(){
            const id = $(this).data('kode');
            const limit = $(this).data('limit');
            for (let i = id+1; i <= 12; i++) {
                $(`#option${i}`).prop('checked',true);
            }
            for (let j = id-1; j > 0; j--) {
                $(`#option${i}`).prop('checked',false);
                
            }
            total(limit,id);

        })
        function total(limit,id) { 
            const kl = id - limit;
            const total = kl * $('#nominal').val();
            $('#total').val(total);
         }
    });
</script>
@endpush