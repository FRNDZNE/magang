<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img src="{{ asset('/') }}/assets/img/logomagang.png" alt="Magang Logo"
                class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">
                Magang <span class="bg-white text-dark px-1 rounded fw-semibold">in</span>
            </span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false" id="navigation">
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">Mentor dan Divisi</li>
                <li class="nav-item">
                    <a href="{{ route('divisions.index') }}"
                        class="nav-link {{ Route::is('divisions.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-diagram-3"></i>
                        <p>Divisi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('mentors.index') }}"
                        class="nav-link {{ Route::is('mentors.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-badge"></i>
                        <p>Mentor</p>
                    </a>
                </li>
                <li class="nav-header">Magang</li>
                <li class="nav-item">
                    <a href="./docs/introduction.html" class="nav-link">
                        <i class="nav-icon bi bi-file-earmark-plus"></i>
                        <p>Pengajuan Magang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./docs/introduction.html" class="nav-link">
                        <i class="nav-icon bi bi-people"></i>
                        <p>Mahasiswa Magang</p>
                    </a>
                </li>
                <li class="nav-header">Penilaian</li>
                <li class="nav-item">
                    <a href="{{ route('scores.index') }}" class="nav-link {{ Route::is('scores.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-clipboard-check"></i>
                        <p>Penilaian</p>
                    </a>
                </li>
                <li class="nav-header">Mahasiswa</li>
                <li class="nav-item">
                    <a href="./docs/introduction.html" class="nav-link">
                        <i class="nav-icon bi bi-journal-text"></i>
                        <p>Logbook</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./docs/introduction.html" class="nav-link">
                        <i class="nav-icon bi bi-calendar-check"></i>
                        <p>Absensi</p>
                    </a>
                </li>
                <li class="nav-header">Role & Permission</li>
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link {{ Route::is('roles.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-journal-text"></i>
                        <p>Role</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('permissions.index') }}"
                        class="nav-link {{ Route::is('permissions.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-calendar-check"></i>
                        <p>Permission</p>
                    </a>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
