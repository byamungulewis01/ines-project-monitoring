<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('student.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="/image/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="/images/logo-sm.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('student.dashboard') }}" class="logo logo-light">
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
                    <x-nav-link class="nav-link menu-link" :href="route('student.dashboard')" :active="request()->routeIs('student.dashboard')">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                    </x-nav-link>

                </li> <!-- end Dashboard Menu -->
                @if (auth()->guard('student')->user()->student_status == 'student')
                    <li class="nav-item">
                        <x-nav-link class="nav-link menu-link" :href="route('student.alumnins.index')" :active="request()->routeIs('student.alumnins.index') ||
                            request()->routeIs('student.alumnins.show')">
                            <i class="ri-account-circle-line"></i> <span data-key="t-alumni">Alumni</span>
                        </x-nav-link>
                    </li>
                @else
                    <li class="nav-item">
                        @php
                            $project = \App\Models\Project::where(
                                'student_id',
                                auth()->guard('student')->id(),
                            )->first();
                            $project_url = $project ? 'student.project.index' : 'student.project.create';
                        @endphp
                        <x-nav-link class="nav-link menu-link" :href="route($project_url)" :active="request()->routeIs($project_url)">
                            <i class="ri-layout-3-line"></i><span data-key="t-project">Project</span>
                        </x-nav-link>

                    </li> <!-- end Dashboard Menu -->
                @endif
                <li class="nav-item">
                    <x-nav-link class="nav-link menu-link" :href="route('student.profile.edit')" :active="request()->routeIs('student.profile.edit')">
                        <i class="ri-user-2-line"></i> <span data-key="t-profile">My Profile</span>
                    </x-nav-link>

                </li> <!-- end Dashboard Menu -->


            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
