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
        </ul>
    </div>
</nav>