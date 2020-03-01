@extends('siswa.layout.template')
@section('page','Dashboard')    
@section('content')    
<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content ">
        <!-- ============================================================== -->
        <!-- pageheader  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Selamat Datang, {{Auth::guard('siswa')->user()->name}} !</h2>
                    <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus
                        vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"
                                        class="breadcrumb-link">E-SPP</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@yield('page')</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end pageheader  -->
        <!-- ============================================================== -->
        
    </div>
</div>
@endsection
@push('script')
    <!-- chart c3 js -->
    <script src="{{asset('assets_backend')}}/vendor/charts/c3charts/c3.min.js"></script>
    <script src="{{asset('assets_backend')}}/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="{{asset('assets_backend')}}/vendor/charts/c3charts/C3chartjs.js"></script>
    <script src="{{asset('assets_backend')}}/libs/js/dashboard-ecommerce.js"></script>
@endpush