@role('student')
    <li class="nav-header">Magang</li>
    <li class="nav-item">
        <a href="{{ route('interns.index') }}"
            class="nav-link {{ Route::is('interns.index') || (Route::is('interns.*') && !Route::is('interns.history.*') && !Route::is('interns.logbook.*') && !Route::is('interns.attendance.*')) ? 'active' : '' }}">
            <i class="nav-icon bi bi-file-earmark-plus"></i>
            <p>Pengajuan Magang</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('interns.history.student', Auth::user()->uuid) }}"
            class="nav-link {{ Route::is('interns.history.student') ? 'active' : '' }}">
            <i class="nav-icon bi bi-clock-history"></i>
            <p>History Pengajuan</p>
        </a>
    </li>
    <li class="nav-header">Mahasiswa</li>
    <li class="nav-item">
        <a href="{{ route('interns.logbook.index', Auth::user()->student->intern->uuid) }}"
            class="nav-link {{ Route::is('interns.logbook.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-journal-text"></i>
            <p>Logbook</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('interns.attendance.index', Auth::user()->student->intern->uuid) }}"
            class="nav-link {{ Route::is('interns.attendance.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-calendar-check"></i>
            <p>Absensi</p>
        </a>
    </li>
@endrole
