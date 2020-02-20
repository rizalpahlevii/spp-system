<div class="brand">
    <a href="index.html"><img src="{{asset('assets_template')}}/img/logo-dark.png" alt="Klorofil Logo" class="img-responsive logo"></a>
</div>
<div class="container-fluid">
    <div class="navbar-btn">
        <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
    </div>
    <div id="navbar-menu">
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('assets_template')}}/img/user.png" class="img-circle" alt="Avatar"> <span>{{Auth::guard('web')->user()->name}}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
                    <li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
                    <li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li>
                    <li><a href="{{route('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                </ul>
            </li>
        </ul>
    </div>
</div>