@extends('backend.layout.template')
@section('page','Edit Siswa')    
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
                <h5 class="card-header">Edit Siswa</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{route('admin.siswa_update',$siswa->id)}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nisn">NISN</label>
                                            <input type="text" name="nisn" id="nisn" class="form-control @error('nisn') is-invalid @enderror" value="{{$siswa->nisn}}" readonly>
                                            @error('nisn')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nis">NIS</label>
                                            <input type="text" name="nis" id="nis" class="form-control @error('nis') is-invalid @enderror" value="{{$siswa->nis}}">
                                        </div>
                                        @error('nis')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Nama Siswa</label>
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{$siswa->name}}">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="no_telp">No Telp</label>
                                            <input type="text" name="no_telp" id="no_telp" class="form-control @error('no_telp') is-invalid @enderror" value="{{$siswa->no_telp}}">
                                            @error('no_telp')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="spp">SPP</label>
                                            <select name="spp" id="spp" class="form-control @error('spp') is-invalid @enderror">
                                                <option disabled selected>--Pilih SPP--</option>
                                                @foreach ($spp as $rowSpp)
                                                    <option value="{{$rowSpp->id}}" <?= ($rowSpp->id == $siswa->spp_id) ? 'selected' :''; ?> >{{$rowSpp->nominal}}</option>
                                                @endforeach
                                            </select>
                                            @error('spp')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="kelas">Kelas</label>
                                            <select name="kelas" id="kelas" class="form-control @error('kelas') is-invalid @enderror">
                                                <option disabled selected>--Pilih Kelas--</option>
                                                @foreach ($kelas as $rowKelas)
                                                    <option value="{{$rowKelas->id}}" <?= ($rowKelas->id == $siswa->kelas_id) ? 'selected' :''; ?>>{{$rowKelas->nama_kelas}}</option>
                                                @endforeach
                                            </select>
                                            @error('kelas')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                                                <option value="Laki-laki" <?= ($siswa->jenis_kelamin == "Laki-laki") ? 'selected':''; ?>>Laki-laki</option>
                                                <option value="Perempuan" <?= ($siswa->jenis_kelamin == "Perempuan") ? 'selected':''; ?>>Perempuan</option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea name="alamat" id="alamat" cols="20" rows="5" class="form-control @error('alamat') is-invalid @enderror">{{$siswa->alamat}}</textarea>
                                            @error('alamat')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="submit" name="submit" value="Edit" class="btn btn-primary">
                                        <a href="{{route('admin.siswa_index')}}" class="btn btn-dark">Kembali</a>
                                    </div>
                                </div>
                            </form>
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
@endpush