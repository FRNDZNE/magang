@role('admin')
    <li class="nav-header">Magang</li>
    <li class="nav-item">
        <a href="{{ route('interns.index') }}"
            class="nav-link {{ Route::is('interns.*') && !Route::is('interns.history') && !Route::is('interns.accepted') ? 'active' : '' }}">
            <i class="nav-icon bi bi-file-earmark-plus"></i>
            <p>Pengajuan Magang</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('interns.history') }}" class="nav-link {{ Route::is('interns.history') ? 'active' : '' }}">
            <i class="nav-icon bi bi-clock-history"></i>
            <p>History Pengajuan Magang</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('interns.accepted') }}" class="nav-link {{ Route::is('interns.accepted') ? 'active' : '' }}">
            <i class="nav-icon bi bi-clipboard-check"></i>
            <p>Magang</p>
        </a>
    </li>
    <li class="nav-header">Divisi</li>
    <li class="nav-item">
        <a href="{{ route('divisions.index') }}" class="nav-link {{ Route::is('divisions.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-diagram-3"></i>
            <p>Divisi</p>
        </a>
    </li>
    <li class="nav-header">Penilaian</li>
    <li class="nav-item">
        <a href="{{ route('scores.index') }}" class="nav-link {{ Route::is('scores.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-clipboard-check"></i>
            <p>Penilaian</p>
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
        <a href="{{ route('permissions.index') }}" class="nav-link {{ Route::is('permissions.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-calendar-check"></i>
            <p>Permission</p>
        </a>
    </li>
    <div class="nav-header">User</div>
    <li class="nav-item">
        <a href="{{ route('mentors.index') }}" class="nav-link {{ Route::is('mentors.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-person-badge"></i>
            <p>Mentor</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('students.index') }}" class="nav-link {{ Route::is('students.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-people"></i>
            <p>Student</p>
        </a>
    </li>
@endrole
