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
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ Route::is('dashboard.' . strtolower(Auth::user()->getRoleNames()->first())) ? 'active' : '' }} @role('mentor') {{ Route::is('interns.*') ? 'active' : '' }} @endrole">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @include('layouts.partials.sidebar.' . strtolower(Auth::user()->getRoleNames()->first()))



            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
