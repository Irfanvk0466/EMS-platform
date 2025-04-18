<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="#" class="logo logo-dark d-block">
            <span class="logo-sm d-block mb-1">
                <img src="{{ URL::asset('assets/images/logo-light.png') }}" alt="Logo" height="30">
            </span>
        </a>

        <!-- Light Logo (optional for dark theme switchers) -->
        <a href="#" class="logo logo-light d-none">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-light.png') }}" alt="Logo" height="30">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('employees.index') }}">
                        <i class="ri-user-settings-line"></i> <span>Employees</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
