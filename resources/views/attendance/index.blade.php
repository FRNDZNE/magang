@extends('layouts.app')
@section('title', 'Absensi')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('page-active', 'active')
@section('content')
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
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['periode'] as $date)
                            @php
                                $attendance = $data['attendance']->firstWhere('date', $date);
                            @endphp
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $date }}</td>
                                <td>{{ $attendance->status ?? 'Belum Absensi' }}</td>
                                <td>
                                    <!-- Modal trigger button -->
                                    <button type="button" class="btn btn-primary btn-lg " data-bs-toggle="modal"
                                        data-bs-target="#modalAttendance-{{ $attendance->id }}">
                                        Absen
                                    </button>

                                    <!-- Modal Body -->
                                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                    <div class="modal fade" id="modalAttendance-{{ $attendance->id }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                        aria-labelledby="modalTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTitleId">
                                                        Presensi
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">Body</div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="button" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
