@extends('backend.layout.template')
@section('page','Tahun Ajaran')    
@section('content')  
<div class="container-fluid  dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Data Tables</h2>
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
                                <th>Tahun Awal</th>
                                <th>Tahun Akhir</th>
                                <th>Tahun Ajaran</th>
                                <th>Pengaturan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tahun_ajaran as $row)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$row->tahun_ajaran_awal}}</td>
                                    <td>{{$row->tahun_ajaran_akhir}}</td>
                                    <td>{{$row->concat_tahun}}</td>
                                    <td>
                                        @if ($row->tahun_ajaran_setting)
                                            @if ($row->tahun_ajaran_setting->is_permanent == "no")
                                                <a href="{{route('admin.ta_edit_setting',$row->id)}}" class="badge badge-warning">Pengaturan belum Permamen</a>    
                                            @else
                                                <span class="badge badge-success">Pengaturan sudah Permamen</span> 
                                            @endif
                                        @else
                                            <span class="badge badge-danger">Pengaturan belum diatur</span>    
                                        @endif
                                    </td>
                                    <td>
                                        
                                        
                                        @if (!$row->tahun_ajaran_setting)
                                            
                                            <a href="#" class="btn btn-success btn-edit" data-kode="{{$row->id}}"><i class="fa fa-cogs"></i></a>
                                            <a href="{{route('admin.ta_setting',$row->id)}}" class="btn btn-success"><i class="fa fa-cogs"></i></a>
                                            <a href="{{route('admin.ta_delete',$row->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>                                      
                                        @else
                                            @if ($row->tahun_ajaran_setting->is_permanent == "no")
                                                
                                                <a href="{{route('admin.ta_edit_setting',$row->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            @endif
                                            <a href="{{route('admin.ta_view_setting',$row->id)}}" class="btn btn-success"><i class="fa fa-list"></i>                                      
                                        @endif
                                        </a>
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
        <form action="{{route('admin.ta_store')}}" method="POST" id="form-ta">
            @csrf
            <input type="hidden" name="id" id="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Tahun Ajaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tahun_awal">Tahun Awal</label>
                                <input type="number" name="tahun_awal" id="tahun_awal" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tahun_akhir">Tahun Akhir</label>
                                <input type="number" name="tahun_akhir" id="tahun_akhir" class="form-control" required>
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
            $('.btn-add').click(function(){
                $('.modal-title').html(`Tambah Tahun Ajaran`);
                $('#tahun_awal').val('');
                $('#tahun_akhir').val('');
                $('.btn-save').html('Simpan');
                $('#form-ta').attr('action',"{{route('admin.ta_store')}}");
            });
            $(document).on('click','.btn-edit',function(){
                $('#form-ta').attr('action',"{{route('admin.ta_update')}}");
                $.ajax({
                    url : "tahun-ajaran/find/"+$(this).data('kode'),
                    method:"get",
                    dataType:"json",
                    success:(response)=>{
                        $('.btn-save').html('Edit');
                        $('.modal-title').html(`Edit Tahun Ajaran ${response.concat_tahun}`);
                        $('#tahun_awal').val(response.tahun_ajaran_awal);
                        $('#tahun_akhir').val(response.tahun_ajaran_akhir);
                        $('#id').val(response.id);
                        $('#exampleModal').modal('show');
                    }
                });
            });
        });
    </script>
@endpush