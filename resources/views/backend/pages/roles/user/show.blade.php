@extends('backend.layout.template')
@section('page','Level Management | '.$level->nama )    
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
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Roles</a></li>
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
                    <div class="row">
                        <div class="col-md-10">
                            <table class="table">
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Icon</th>
                                    <th>URI</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($menu as $key => $item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->icon}} | <i class="{{$item->icon}}"></i></td>
                                        <td>{{$item->uri}}</td>
                                        <td>
                                            <div class="switch-button switch-button-success">
                                                <input type="checkbox" name="cek{{$key}}" id="cek{{$key}}" {{set_checked($item->id,$level->id)}} class="cek-btn" data-menu="{{$item->id}}" data-level="{{$level->id}}"><span>
                                            <label for="cek{{$key}}"></label></span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('click','.cek-btn',function(){
                const menuId = $(this).data('menu');
                const levelId = $(this).data('level');
                $.ajax({
                    url : "{{route('admin.role_user_save')}}",
                    method : "POST",
                    data : {
                        menuId : menuId,
                        levelId : levelId,
                    },
                    success:function(response)
                    {
                        location.reload();
                    }
                });
            });
        });
    </script>
@endpush