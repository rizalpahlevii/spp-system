@extends('admin.layout.template')
@section('page','Setting Tahun Ajaran '.$tahun_ajaran->concat_tahun)
@section('content')
<div class="container-fluid">
    <!-- OVERVIEW -->
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">@yield('page')</h3>
        </div>
        <div class="panel-body">
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
