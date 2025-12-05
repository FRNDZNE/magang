<li class="nav-item dropdown">
    <a class="nav-link" data-bs-toggle="dropdown" href="#">
        <i class="bi bi-bell-fill"></i>
        <span class="navbar-badge badge text-bg-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
        @forelse (auth()->user()->unreadNotifications as $notification)
            <a href="" class="dropdown-item">
                <!--begin::Message-->
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="rounded-circle bg-primary d-flex justify-content-center align-items-center me-3"
                            style="width: 55px; height: 55px;">
                            <i class="{{ $notification->data['icon'] }} text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h3 class="dropdown-item-title">
                            {{ $notification->data['heading'] }}
                            <span class="float-end fs-7 text-danger"><i class="bi bi-star-fill"></i></span>
                        </h3>
                        <p class="fs-7">{{ \Illuminate\Support\Str::limit($notification->data['message'], 20) }}</p>
                        <p class="fs-7 text-secondary">
                            <i class="bi bi-clock-fill me-1"></i> {{ $notification->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
                <!--end::Message-->
            </a>
            <div class="dropdown-divider"></div>
        @empty
            <a href="#" class="dropdown-item">
                <!--begin::Message-->
                <div class="d-flex">
                    <p class="text-center">Tidak Ada Notifikasi</p>
                </div>
                <!--end::Message-->
            </a>
            <div class="dropdown-divider"></div>
        @endforelse

        <div class="dropdown-divider"></div>
        <a href="{{ route('notifications.index') }}" class="dropdown-item dropdown-footer">See All Notification</a>
    </div>
</li>
<!--end::Notification Dropdown Menu-->
<!--begin::Fullscreen Toggle-->
