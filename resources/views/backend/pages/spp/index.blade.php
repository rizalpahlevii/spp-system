@extends('backend.layout.template')
@section('page','SPP')    
@section('content')  
<div class="container-fluid  dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Data SPP</h2>
                <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">E-SPP</a></li>
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">SPP</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data SPP</li>
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
                <h5 class="card-header">Data SPP</h5>
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
                                    <th>Tahun Ajaran</th>
                                    <th>Nominal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($spp as $row)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->tahun_ajaran->concat_tahun}}</td>
                                        <td>{{rupiah($row->nominal)}}</td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-edit" data-kode="{{$row->id}}"><i class="fas fa-edit"></i></a>
                                            <a href="{{route('admin.spp_delete',$row->id)}}" class="btn btn-danger btn-delete" onclick="return confirm('Yakin ingin menghapus data ini ?')"><i class="fas fa-trash-alt"></i></a>
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
        <form action="{{route('admin.spp_create')}}" method="POST" id="form-spp">
        @csrf
            <input type="hidden" name="id" id="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah SPP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tahun_ajaran">Tahun Ajaran</label>
                                <select name="tahun_ajaran" id="tahun_ajaran" class="form-control" required>
                                    <option>--Pilih Tahun Ajaran--</option>
                                    @foreach ($tahun_ajaran as $item)
                                        <option value="{{$item->id}}">{{$item->concat_tahun}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nominal">Nominal</label>
                                <input type="text" name="nominal" id="nominal" class="form-control" required>
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
                $('.modal-title').html(`Tambah SPP`);
                $('#nominal').val('');
                $('.btn-save').html('Simpan');
                $('#form-spp').attr('action',"{{route('admin.spp_create')}}");
            });
            $(document).on('click','.btn-edit',function(){
                $('#form-spp').attr('action',"{{route('admin.spp_update')}}");
                $.ajax({
                    url : "spp/find/"+$(this).data('kode'),
                    method:"get",
                    dataType:"json",
                    success:(response)=>{
                        console.log(response);
                        $('.btn-save').html('Edit');
                        $('.modal-title').html(`Edit SPP ${response.tahun_ajaran.concat_tahun}`);
                        $('#tahun_ajaran').val(response.tahun_ajaran.id);
                        $('#nominal').val(response.nominal);
                        $('#id').val(response.id);
                        $('#exampleModal').modal('show');
                    }
                });
            });
        });
    </script>
@endpush