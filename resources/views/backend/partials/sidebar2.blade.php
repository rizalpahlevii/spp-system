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
            @foreach (sidebar() as $item)
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(2) == $item->uri ? "active":"" }}" href="{{route('admin.'.$item->route)}}"><i class="{{$item->icon}}"></i>{{$item->title}} <span class="badge badge-success">6</span></a>
                </li>
            @endforeach
            
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