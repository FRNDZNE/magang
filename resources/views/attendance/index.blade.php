@extends('layouts.app')
@section('title', 'Absensi')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('page-active', 'active')
@section('content')
    @php
        $status = [
            's' => [
                'text' => 'Sakit',
                'color' => 'warning',
            ],
            'i' => [
                'text' => 'Izin',
                'color' => 'info',
            ],
            'a' => [
                'text' => 'Tanpa Keterangan',
                'color' => 'dark',
            ],
            'h' => [
                'text' => 'Hadir',
                'color' => 'success',
            ],
            'l' => [
                'text' => 'Libur',
                'color' => 'danger',
            ],
        ];
    @endphp
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Absensi Magang</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Status</th>
                            <th scope="col">Catatan</th>
                            <th scope="col">Validasi Mentor</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['periode'] as $date)
                            @php
                                $attendance = $data['attendance']->firstWhere('date', $date);
                                $stat = $attendance && $attendance->status ? $status[$attendance->status] : null;
                            @endphp
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $date }}</td>
                                <td>
                                    @if ($stat)
                                        <span class="badge bg-{{ $stat['color'] }}">
                                            {{ $stat['text'] }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">Belum Absensi</span>
                                    @endif
                                </td>
                                <td>{{ $attendance && $attendance->notes ? $attendance->notes : 'Tidak Ada Catatan' }}</td>
                                <td>
                                    @if ($attendance)
                                        @if ($attendance->validated)
                                            <span class="badge bg-success">Sudah Divalidasi</span>
                                        @else
                                            <span class="badge bg-danger">Belum Divalidasi</span>

                                        @endif
                                    @else
                                        <span class="badge bg-secondary">Belum Absensi</span>
                                    @endif
                                </td>
                                <td>
                                    @role('student')
                                        <!-- Modal trigger button -->
                                        <button type="button" class="btn btn-info btn-md"
                                            @if ($data['today'] < $date) disabled @endif data-bs-toggle="modal"
                                            data-bs-target="#modalAttendance-{{ $date }}">
                                            Absen
                                        </button>

                                        <!-- Modal Body -->
                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                        <div class="modal fade" id="modalAttendance-{{ $date }}" tabindex="-1"
                                            data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                            aria-labelledby="modalTitleId" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitleId">
                                                            Presensi
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('interns.attendance.store', $intern->uuid) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $attendance->id ?? '' }}">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="date">Tanggal</label>
                                                                <input type="date" name="date" id="date"
                                                                    value="{{ $date }}"
                                                                    class="form-control @error('date') is-invalid @else @if (old('date')) is-valid @endif @enderror"
                                                                    readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="status">Status Kehadiran</label>
                                                                <select name="status" id="status"
                                                                    class="form-control @error('status') is-invalid @else @if (old('status')) is-valid @endif @enderror">
                                                                    <option value="">Pilih Status Kehadiran</option>
                                                                    @foreach ($status as $key => $value)
                                                                        <option value="{{ $key }}"
                                                                            @if ($attendance) @if ($attendance->status == $key) selected @endif
                                                                            @endif>
                                                                            {{ $value['text'] }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('status')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @else
                                                                    <span class="valid-feedback">Sudah Diisi</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="notes">Alasan</label>
                                                                <input type="text" name="notes" id="notes"
                                                                    class="form-control @error('notes') is-invalid @else @if (old('notes')) is-valid @endif @enderror"
                                                                    value="{{ $attendance->notes ?? old('notes') }}">
                                                                <small>Isian opsional</small>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                Close
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endrole
                                    {{-- Button Validasi --}}
                                    @role('mentor')
                                        @if ($attendance)
                                            <!-- Modal trigger button -->
                                            <button type="button" class="btn btn-dark btn-md" data-bs-toggle="modal"
                                                data-bs-target="#modalValidation-{{ $attendance->id }}">
                                                Validasi
                                            </button>

                                            <!-- Modal Body -->
                                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                            <div class="modal fade" id="modalValidation-{{ $attendance->id }}" tabindex="-1"
                                                data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                                aria-labelledby="modalTitleId" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalTitleId">
                                                                Validasi Absensi {{ $date }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form
                                                            action="{{ route('interns.attendance.validation', $intern->uuid) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="id"
                                                                value="{{ $attendance->id }}">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="validated">Validasi</label>
                                                                    <select name="validated" id="validated"
                                                                        class="form-control">
                                                                        <option value="0">Belum Divalidasi</option>
                                                                        <option value="1">Validasi</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    Close
                                                                </button>
                                                                <button type="submit" class="btn btn-dark">Validasi</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Optional: Place to the bottom of scripts -->
                                            <script>
                                                const myModal = new bootstrap.Modal(
                                                    document.getElementById("modalId"),
                                                    options,
                                                );
                                            </script>
                                        @endif
                                    @endrole
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        @role('mentor|admin')
            <div class="card-footer">
                <a href="{{ route('interns.show', $intern->uuid) }}" class="btn btn-secondary btn-md">Kembali</a>
            </div>
        @endrole
    </div>
@endsection
