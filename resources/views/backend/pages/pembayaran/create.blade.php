@extends('backend.layout.template')
@section('page','Tambah Pembayaran')    
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
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pembayaran SPP</a></li>
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
                    <form action="{{route('admin.pembayaran_store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="how_many_months" id="how_many_months">
                        <input type="hidden" name="siswa_id" id="siswa_id">
                        <input type="hidden" name="terakhir_bayar_value" id="terakhir_bayar_value">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="for">NIS ( No Induk Siswa )</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend click-nis" style="cursor:pointer;">
                                            <span class="input-group-text">NIS</span>
                                        </div>
                                        <input type="text" placeholder="NIS" class="form-control" name="nis" id="nis">
                                    </div>
                                    @error('nis')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control" readonly style="cursor:no-drop;">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <input type="text" name="kelas" id="kelas" class="form-control" readonly style="cursor:no-drop;">
                                    @error('kelas')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="spp_terakhir">SPP Terakhir</label>
                                    <input type="text" name="spp_terakhir" id="spp_terakhir" class="form-control" readonly style="cursor:no-drop;">
                                    @error('spp_terkhir')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bayar_sampai">Bayar Sampai</label>
                                    <select name="bayar_sampai" id="bayar_sampai" class="form-control" disabled>
                                        <option disabled selected>--Pilih Opsi Berikut--</option>
                                    </select>
                                    @error('byara_sampai')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="total_bayar">Total Bayar</label>
                                    <input type="text" name="total_bayar" id="total_bayar" class="form-control" readonly style="cursor:no-drop;">
                                    @error('total_bayar')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <input type="submit" name="submit" name="submit" value="Simpan" class="btn btn-primary mt-4">
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
<input type="hidden" name="length_nis" id="length_nis" value="{{$length_nis}}">
<input type="hidden" name="nominal_spp" id="nominal_spp" value="150000">
@endsection
@push('script')
<script>
    $(document).ready(function(){
        $('#nis').keyup(function(){
            if($(this).val().length >= $('#length_nis').val())
            {
                nis = $(this).val();
                $.ajax({
                    url : "ajax/getSiswa/"+nis,
                    method:"GET",
                    dataType:"json",
                    success:function(response)
                    {
                        console.log(response);
                        $('#terakhir_bayar_value').val(response.data.terakhir_spp_value)
                        $('#nominal_spp').val(response.data.nominal_spp);
                        $('#name').val(response.data_siswa.name);
                        $('#siswa_id').val(response.data_siswa.id);
                        $('#kelas').val(response.data_siswa.kelas.nama_kelas);
                        if(response.data.terakhir_spp == 0){
                            $('#spp_terakhir').val('Belum Bayar');
                        }else{
                            $('#spp_terakhir').val(response.data.terakhir_spp);
                        }
                        var html_option="";
                        $.each(response.data.option_bayar,function(key,value){
                            html_option+=`<option value="${value.id}" data-kode="${key+1}">${value.name}</option>`;
                        });
                        $('#bayar_sampai').removeAttr('disabled');
                        $('#bayar_sampai').html(html_option);
                        load_total(response.data.terakhir_spp_value,response.data.terakhir_spp_value+1);
                    }
                });
            }
        });
        $('#bayar_sampai').change(function(){
            const value = $(this).val();
            load_total($('#terkahir_bayar_value').val(),$(this).val());
        });
        function load_total(terakhir_bayar,bayar_sampai){
            const nominal = $('#nominal_spp').val();
            const vb = bayar_sampai-terakhir_bayar;
            const kl = $('#bayar_sampai option:selected').data('kode');
            const result = nominal*kl;
            $('#how_many_months').val(kl);
            $('#total_bayar').val(result);
        }
    });
</script>
@endpush