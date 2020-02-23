@extends('backend.layout.template')
@section('page','Setting Tahun Ajaran')
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
                    <form action="{{route('admin.ta_save_setting',$tahun_ajaran->id)}}" method="POST">
                     @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    @for ($i = 1; $i < 13; $i++)
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="bulan_ke{{$i}}">Bulan Ke {{$i}}</label>
                                                <select  name="bulan_ke{{$i}}" id="bulan_ke{{$i}}" class="form-control" <?= ($i > 1) ? 'readonly':'';?> >
                                                    <option disabled selected>--Pilih Bulan Ke {{$i}}--</option>
                                                    @foreach (getBulan() as $item)
                                                        <option value="{{$item['id']}}">{{$item['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
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
        });
    </script>
@endpush