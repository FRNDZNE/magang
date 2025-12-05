<nav class="app-header navbar navbar-expand bg-body">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
        </ul>
        <!--end::Start Navbar Links-->
        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">
            <!--begin::Notification Dropdown Menu-->
            @include('layouts.partials.header.notification')
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                </a>
            </li>
            <!--end::Fullscreen Toggle-->
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    @role('admin')
                        <img src="{{ asset('/') }}/assets/img/admin-160x160.png" class="user-image rounded-circle shadow"
                            alt="User Image" />
                    @endrole
                    @role('mentor')
                        <img src="{{ asset('/') }}/assets/img/mentor-160x160.png"
                            class="user-image rounded-circle shadow" alt="User Image" />
                    @endrole
                    @role('student')
                        <img src="{{ asset('/') }}/assets/img/student-160x160.png"
                            class="user-image rounded-circle shadow" alt="User Image" />
                    @endrole
                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <!--begin::User Image-->
                    <li class="user-header text-bg-primary">
                        @role('admin')
                            <img src="{{ asset('/') }}/assets/img/admin-160x160.png" class="rounded-circle shadow"
                                alt="User Image" />
                        @endrole
                        @role('mentor')
                            <img src="{{ asset('/') }}/assets/img/mentor-160x160.png" class="rounded-circle shadow"
                                alt="User Image" />
                        @endrole
                        @role('student')
                            <img src="{{ asset('/') }}/assets/img/student-160x160.png" class="rounded-circle shadow"
                                alt="User Image" />
                        @endrole
                        <p>
                            {{ Auth::user()->name }} - {{ ucfirst(Auth::user()->getRoleNames()->first()) }}
                            <small>{{ ucfirst(Auth::user()->getRoleNames()->first()) }} since
                                {{ ucfirst(Auth::user()->created_at->translatedFormat('F')) }}
                                {{ ucfirst(Auth::user()->created_at->translatedFormat('Y')) }}</small>
                        </p>
                    </li>
                    <!--end::User Image-->
                    <li class="user-footer">
                        <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat">Profile</a>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                            class="btn btn-default btn-flat float-end">Sign out</a>
                        <form action="{{ route('logout') }}" method="post" id="logout-form" class="d-none">
                            @csrf
                        </form>
                    </li>
                    <!--end::Menu Footer-->
                </ul>
            </li>
            <!--end::User Menu Dropdown-->
        </ul>
        <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
</nav>
