<nav class="navbar navbar-expand-lg navbar-light">
    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav flex-column">
            <li class="nav-divider">
                Menu
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.dashboard')}}"><i class="fa fa-fw fa-user-circle"></i>Dashboard
                    <span class="badge badge-success">6</span></a>
                <a class="nav-link" href="{{route('admin.ta_index')}}"><i class="fa fa-fw fa-user-circle"></i>Tahun
                    Ajaran
                    <span class="badge badge-success">6</span></a>
                <a class="nav-link" href="{{route('admin.kelas_index')}}"><i class="fa fa-fw fa-user-circle"></i>Kelas
                    <span class="badge badge-success">6</span></a>
                <a class="nav-link" href="{{route('admin.siswa_index')}}"><i class="fa fa-fw fa-user-circle"></i>Siswa
                    <span class="badge badge-success">6</span></a>
                <a class="nav-link" href="{{route('admin.spp_index')}}"><i class="fa fa-fw fa-user-circle"></i>spp
                    <span class="badge badge-success">6</span></a>
                <a class="nav-link" href="{{route('admin.petugas_index')}}"><i
                        class="fa fa-fw fa-user-circle"></i>petugas
                    <span class="badge badge-success">6</span></a>
                <a class="nav-link" href="{{route('admin.pembayaran_index')}}"><i
                        class="fa fa-fw fa-user-circle"></i>Pembayaran
                    <span class="badge badge-success">6</span></a>
            </li>
        </ul>
    </div>
</nav>