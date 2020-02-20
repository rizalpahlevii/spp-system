<div class="sidebar-scroll">
    <nav>
        <ul class="nav">
            <li><a href="{{route('admin.dashboard')}}" class="{{set_active('admin.dashboard')}}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
            <li><a href="{{route('admin.ta_index')}}" class="{{set_active(['admin.ta_index','admin.ta_view_setting','admin.ta_edit_setting'])}}"><i class="lnr lnr-code"></i> <span>Tahun Ajaran</span></a></li>
            <li><a href="charts.html" class=""><i class="lnr lnr-chart-bars"></i> <span>Charts</span></a></li>
            <li><a href="panels.html" class=""><i class="lnr lnr-cog"></i> <span>Panels</span></a></li>
            <li><a href="notifications.html" class=""><i class="lnr lnr-alarm"></i> <span>Notifications</span></a></li>
            <li>
                <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Pages</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                <div id="subPages" class="collapse ">
                    <ul class="nav">
                        <li><a href="page-profile.html" class="">Profile</a></li>
                        <li><a href="page-login.html" class="">Login</a></li>
                        <li><a href="page-lockscreen.html" class="">Lockscreen</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="tables.html" class=""><i class="lnr lnr-dice"></i> <span>Tables</span></a></li>
            <li><a href="typography.html" class=""><i class="lnr lnr-text-format"></i> <span>Typography</span></a></li>
            <li><a href="icons.html" class=""><i class="lnr lnr-linearicons"></i> <span>Icons</span></a></li>
        </ul>
    </nav>
</div>