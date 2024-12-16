<div class="app-menu navbar-menu">

    <div class="navbar-brand-box">

        <a href="{{ request()->user()->hasRole(['admin']) == request()->user()->hasRole(['admin']) ? route('admin_dashboard') : '' }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('images/unsap.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <div class="d-flex align-items-center justify-content-center gap-2">
                    <img src="{{ asset('images/unsap.png') }}" alt="" height="22">
                    <span class="fs-3 text-white">UNSAP</span>
                </div>
            </span>
        </a>

        <a href="{{ request()->user()->hasRole(['admin']) == request()->user()->hasRole(['admin']) ? route('admin_dashboard') : '' }}" class="logo lotext-white">
            <span class="logo-sm">
                <img src="{{ asset('images/unsap.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <div class="d-flex align-items-center justify-content-center gap-2">
                    <img src="{{ asset('images/unsap.png') }}" alt="" height="22">
                    <span class="fs-3 text-white">UNSAP</span>
                </div>
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu"></div>

            <ul class="navbar-nav" id="navbar-nav">

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-menu">Menu</span></li>

                @if (getUser()->hasRole(['admin']))
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin_dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i> <span data-key="t-dasboard">Dasboard</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-general">General</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#configuration" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="configuration">
                        <i class="mdi mdi-shield-account-outline"></i>
                        <span data-key="t-configuration">Configuration</span>
                    </a>
                    <div class="collapse menu-dropdown" id="configuration">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('configuration.users.index') }}" class="nav-link"
                                    data-key="t-users">Users</a>
                            </li>

                            <li class="nav-item">
                                <a href="advance-ui-nestable.html" class="nav-link"
                                    data-key="t-permissions">Permissions</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#master-data" data-bs-toggle="collapse"
                        role="button" aria-expanded="true" aria-controls="master-data">
                        <i class="mdi mdi-database-cog-outline"></i>
                        <span data-key="t-master-data">Master Data</span>
                    </a>
                    <div class="collapse menu-dropdown" id="master-data">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('master-data.students.index') }}" class="nav-link"
                                    data-key="t-students">Students</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('master-data.faculty.index') }}" class="nav-link"
                                    data-key="t-faculty">Faculty</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('master-data.study-program.index') }}" class="nav-link"
                                    data-key="t-study-program">Study Program</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('master-data.class-name.index') }}" class="nav-link {{ Route::is('master-data.class.index') ? 'active' : '' }}"
                                    data-key="t-class">Class</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('master-data.courses.index') }}" class="nav-link"
                                    data-key="t-course">Course</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('master-data.schedules.index') }}" class="nav-link"
                                    data-key="t-schedule">Schedule</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                @if (getUser()->hasRole(['teacher']))
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('teacher_dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i> <span data-key="t-dasboard">Dasboard</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-academic">Academic</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#academic" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="academic">
                        <i class="mdi mdi-bookshelf"></i>
                        <span data-key="t-academic">Academic</span>
                    </a>
                    <div class="collapse menu-dropdown" id="academic">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('academic.schedules.index') }}" class="nav-link"
                                    data-key="t-students">Schedule</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('academic.attendance.index') }}" class="nav-link"
                                    data-key="t-students">Atendance</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-other">Others</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="">
                        <i class="mdi mdi-account-circle-outline"></i> <span data-key="t-profile">Profile</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('logout') }}">
                        <i class="mdi mdi-logout-variant"></i> <span data-key="t-logout">Logout</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>
