@extends('admin.layout.template')
@section('page','Tahun Ajaran')
@section('content')
<div class="container-fluid">
    <!-- OVERVIEW -->
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Data Tahun Ajaran</h3>
        </div>
        <div class="panel-body">
            @if (Session::has('message'))
                <div class="row">
                    <div class="col-md-8">
                        <div class="alert alert-{{Session::get('message_type')}} alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="fa fa-info-circle"></i> {{Session::get('message')}}
                        </div>
                    </div>
                </div>
            @endif
            <div class="row mb-2">
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary btn-add" data-toggle="modal" data-target="#myModal">
                    Tambah
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
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
                                        
                                        {{-- <a href="{{route('admin.ta_delete',$row->id)}}" class="btn btn-danger btn-delete" onclick="return confirm('Yakin ingin menghapus data ini ?')"><i class="fas fa-trash-alt"></i></a> --}}
                                        
                                        @if (!$row->tahun_ajaran_setting)
                                            
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
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
            $('.table-bordered').dataTable();
            $('.btn-add').click(function(){
                $('.modal-title').html(`Tambah Tahun Ajaran`);
                $('#tahun_awal').val('');
                $('#tahun_akhir').val('');
                $('.btn-save').html('Simpan');
                $('#form-ta').attr('action',"{{route('admin.ta_store')}}");
            });
        });
    </script>
@endpush