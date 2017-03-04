<nav class="sidebar-nav">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/videos/index') }}"><i class="icon-speedometer"></i> Videos <span class="badge badge-info">NEW</span></a>
        </li>
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i> Games</a>
            <ul class="nav-dropdown-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/game/index') }}"><i class="icon-puzzle"></i> Game Objects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/categories/index') }}"><i class="icon-puzzle"></i> Game Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/strokes/index') }}"><i class="icon-puzzle"></i> Game Strokes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/pronounce/index') }}"><i class="icon-puzzle"></i> Game Pronunciation</a>
                </li>
            </ul>
        </li>
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-settings"></i> Settings</a>
            <ul class="nav-dropdown-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/user/index') }}"><i class="icon-people"></i> Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/themes/index') }}"><i class="icon-star"></i> Themes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/language/index') }}"><i class="icon-star"></i> Languages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/questions/index') }}"><i class="icon-star"></i> Q & A</a>
                </li>
            </ul>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/childprogress/index') }}"><i class="fa fa-bar-chart"></i> Report</a>
        </li> --}}
    </ul>
</nav>