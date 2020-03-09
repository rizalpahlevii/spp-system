<nav class="navbar navbar-expand-lg navbar-light">
    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav flex-column">
            <li class="nav-divider">
                Menu
            </li>
            <li class="nav-item ">
                <a class="nav-link {{set_active(['admin.dashboard'])}}" href="{{route('admin.dashboard')}}"><i class="fa fa-fw fa-user-circle"></i>Dashboard <span class="badge badge-success">6</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link {{set_active(['admin.ta_index'])}}" href="{{route('admin.ta_index')}}"><i class="fa fa-fw fa-calendar-alt"></i>Tahun Ajaran <span class="badge badge-success">6</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link {{set_active(['admin.kelas_index','admin.kelas_siswa'])}}" href="{{route('admin.kelas_index')}}"><i class="fa fa-fw fa-warehouse"></i>Kelas <span class="badge badge-success">6</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link {{set_active(['admin.siswa_index','admin.siswa_create','admin.siswa_detail','admin.siswa_show','admin.siswa_spp'])}}" href="{{route('admin.siswa_index')}}"><i class="fas fa-fw fa-graduation-cap"></i>Siswa <span class="badge badge-success">6</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link {{set_active(['admin.spp_index'])}}" href="{{route('admin.spp_index')}}"><i class="fa fa-fw fa-money-bill-alt"></i>SPP <span class="badge badge-success">6</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link {{set_active(['admin.petugas_index','admin.petugas_create','admin.petugas_edit'])}}" href="{{route('admin.petugas_index')}}"><i class="fa fa-fw fa-users"></i>Petugas <span class="badge badge-success">6</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link {{set_active(['admin.pembayaran_index','admin.pembayaran_create'])}}" href="{{route('admin.pembayaran_index')}}"><i class="fas fa-fw fa-list"></i>Pembayaran SPP <span class="badge badge-success">6</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{set_active(['admin.role_menu','admin.role_user'])}}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-fw fa-chart-pie"></i>Roles</a>
                <div id="submenu-3" class="collapse submenu" style="">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.role_menu')}}">Menu Management</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.role_user')}}">Role User Management</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>