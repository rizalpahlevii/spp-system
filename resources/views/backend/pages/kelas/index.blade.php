@extends('backend.layout.template')
@section('page','Kelas')    
@section('content')  
<div class="container-fluid  dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Data Kelas</h2>
                <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">E-SPP</a></li>
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Kelas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Kelas</li>
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
                <h5 class="card-header">Data Kelas</h5>
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
                    <button type="button" class="btn btn-primary mb-2 btn-add" data-toggle="modal" data-target="#exampleModal">
                    Tambah Data
                    </button>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Kelas</th>
                                    <th>Kelas</th>
                                    <th>Kompetensi Keahlian</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelas as $row)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->nama_kelas}}</td>
                                        <td>{{$row->master_kelas->name}}</td>
                                        <td>{{$row->kompetensi_keahlian}}</td>
                                        <td>{{$row->tahun_ajaran->concat_tahun}}</td>
                                        <td>
                                            <a href="{{route('admin.kelas_siswa',$row->id)}}" class="btn btn-success" data-kode="{{$row->id}}"><i class="fas fa-user"></i></a>
                                            <a href="#" class="btn btn-warning btn-edit" data-kode="{{$row->id}}"><i class="fas fa-edit"></i></a>
                                            <a href="{{route('admin.kelas_delete',$row->id)}}" class="btn btn-danger btn-delete" onclick="return confirm('Yakin ingin menghapus data ini ?')"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('admin.kelas_create')}}" method="POST" id="form-kelas">
        @csrf
            <input type="hidden" name="id" id="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nama Kelas</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="kompetensi_keahlian">Kompetensi keahlian</label>
                                <input type="text" name="kompetensi_keahlian" id="kompetensi_keahlian" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tahun_ajaran">Tahun Ajaran</label>
                                <select name="tahun_ajaran" id="tahun_ajaran" class="form-control" required>
                                    <option disabled selected>--Pilih Tahun Ajaran--</option>
                                    @foreach ($tahun_ajaran as $rowt)
                                        <option value="{{$rowt->id}}">{{$rowt->concat_tahun}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="master_kelas">Kelas</label>
                                <select name="master_kelas" id="master_kelas" class="form-control" required>
                                    <option disabled selected>--Pilih Kelas--</option>
                                    @foreach ($master_kelas as $rowm)
                                        <option value="{{$rowm->id}}">{{$rowm->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-save">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('script')
    <script>
        $(document).ready(function(){
            $('.table').dataTable();
            $('.btn-add').click(function(){
                $('.modal-title').html(`Tambah Kelas`);
                $('#name').val('');
                $('#kompetensi_keahlian').val('');
                $('#master_kelas').val('');
                $('#tahun_ajaran').val('');
                $('.btn-save').html('Simpan');
                $('#form-kelas').attr('action',"{{route('admin.kelas_create')}}");
            });
            $(document).on('click','.btn-edit',function(){
                $('#form-kelas').attr('action',"{{route('admin.kelas_update')}}");
                $.ajax({
                    url : "kelas/find/"+$(this).data('kode'),
                    method:"get",
                    dataType:"json",
                    success:(response)=>{
                        $('.btn-save').html('Edit');
                        $('.modal-title').html(`Edit Kelas ${response.nama_kelas}`);
                        $('#name').val(response.nama_kelas);
                        $('#id').val(response.id);
                        $('#kompetensi_keahlian').val(response.kompetensi_keahlian);
                        $('#master_kelas').val(response.master_kelas.name);
                        $('#tahun_ajaran').val(response.tahun_ajaran.id);
                        $('#exampleModal').modal('show');
                    }
                });
            });
            $(document).on('click','.btn-delete',function(){
            });
        });
    </script>
@endpush