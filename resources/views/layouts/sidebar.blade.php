<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="/image/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="/images/logo-sm.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="/images/logo-sm.png" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <x-nav-link class="nav-link menu-link" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                    </x-nav-link>

                </li> <!-- end Dashboard Menu -->
                @if (auth()->user()->role == 'admin')
                    <li class="nav-item">
                        <x-nav-link class="nav-link menu-link" :href="route('users.index')" :active="request()->routeIs('users.index')">
                            <i class="ri-user-line"></i> <span data-key="t-users">Users</span>
                        </x-nav-link>
                    </li>

                    <li class="nav-item">
                        <x-nav-link class="nav-link menu-link" :href="route('students.index')" :active="request()->routeIs('students.index')">
                            <i class="ri-account-circle-line"></i> <span data-key="t-students">Students</span>
                        </x-nav-link>
                    </li>


                    <li class="nav-item">

                        <x-nav-link class="nav-link menu-link" :href="route('projects.index')" :active="request()->routeIs('projects.index') || request()->routeIs('projects.show')">
                            <i class="ri-layout-3-line"></i><span data-key="t-products">Projects</span>
                        </x-nav-link>

                    </li> <!-- end Dashboard Menu -->
                    <li class="nav-item">

                        <x-nav-link class="nav-link menu-link">
                            <i class="ri-apps-2-line"></i><span data-key="t-orders">Requests</span>
                        </x-nav-link>

                    </li> <!-- end Dashboard Menu -->
                    <li class="nav-item">

                        <x-nav-link class="nav-link menu-link" :href="route('departments.index')" :active="request()->routeIs('departments.index')">
                            <i class="ri-pie-chart-line"></i> <span data-key="t-orders">Departments</span>
                        </x-nav-link>

                    </li>
                @elseif (auth()->user()->role == 'academic')
                    <li class="nav-item">
                        <x-nav-link class="nav-link menu-link" :href="route('students.index')" :active="request()->routeIs('students.index')">
                            <i class="ri-account-circle-line"></i> <span data-key="t-students">Students</span>
                        </x-nav-link>
                    </li>
                @else
                    <li class="nav-item">

                        <x-nav-link class="nav-link menu-link" :href="route('projects.index')" :active="request()->routeIs('projects.index') || request()->routeIs('projects.show')">
                            <i class="ri-layout-3-line"></i><span data-key="t-products">Projects</span>
                        </x-nav-link>

                    </li> <!-- end Dashboard Menu -->
                    <li class="nav-item">

                        <x-nav-link class="nav-link menu-link">
                            <i class="ri-apps-2-line"></i><span data-key="t-orders">Requests</span>
                        </x-nav-link>

                    </li> <!-- end Dashboard Menu -->
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
