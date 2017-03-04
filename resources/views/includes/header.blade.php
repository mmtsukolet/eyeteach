<button class="navbar-toggler mobile-sidebar-toggler hidden-lg-up" type="button">☰</button>
<a class="navbar-brand" href="#"></a> 
<a href="#"></a>
<ul class="nav navbar-nav hidden-md-down">
    <li class="nav-item">
        <a class="nav-link navbar-toggler sidebar-toggler" href="#">☰</a>
    </li>
</ul>
<ul class="nav navbar-nav ml-auto">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            {{-- <img src="img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com"> --}}
            <span class="hidden-md-down">admin</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">   

            <a class="dropdown-item" href="{{ url('admin/videos/index') }}"><i class="icon-speedometer"></i> Videos</a>
             <div class="dropdown-header text-center">
                <strong>Settings</strong>
            </div>
            <a class="dropdown-item" href="{{ url('admin/user/index') }}"><i class="fa fa-user"></i> Users</a>
            <a class="dropdown-item" href="{{ url('admin/themes/index') }}"><i class="icon-star"></i> Themes</a>
            <div class="divider"></div>
            <a class="dropdown-item"  href="{{ url('logout') }}"><i class="fa fa-lock"></i> Logout</a>
        </div>
    </li>
    <li class="nav-item hidden-md-down">
        {{-- <a class="nav-link navbar-toggler aside-menu-toggler" href="#">&#9776;</a> --}}
    </li>

</ul>