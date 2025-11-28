@extends('layouts.app')
@section('title', 'Pengajuan Magang')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('page-active', 'active')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pengajuan Magang</h3>
        </div>
        <div class="card-body">
            @role('student')
                @php
                    $intern = Auth::user()->student->intern ? Auth::user()->student->intern->count() : 0;
                @endphp
                <a href="{{ route('interns.create') }}"
                    class="btn btn-primary mb-3 @if ($intern >= 1) d-none @endif">
                    <i class="bi bi-plus-lg"></i> Ajukan Magang
                </a>
                <hr>
            @endrole
            <table class="table table-bordered">
                @role('admin')
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Asal Institusi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                @endrole
                @role('student')
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Divisi Tujuan</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                @endrole
                @role('admin')
                    @foreach ($data as $d)
                        <tbody>
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->student->user->name }}</td>
                                <td>{{ $d->student->institution }}</td>
                                <td>
                                    <a href="{{ route('interns.show', $d->uuid) }}" class="btn btn-info btn-md">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                @endrole
                @role('student')
                    @if ($intern == 0)
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data magang.</td>
                        </tr>
                    @else
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{ $data->division->name }}</td>
                                <td>{{ $data->start_date }}</td>
                                <td>{{ $data->end_date }}</td>
                                <td>
                                    <a href="{{ route('interns.show', $data->uuid) }}" class="btn btn-info btn-md">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('interns.edit', $data->uuid) }}" class="btn btn-warning btn-md">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <!-- Modal trigger button -->
                                    <button type="button" class="btn btn-danger btn-md" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete{{ $data->uuid }}">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                    <!-- Modal Body -->
                                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                    <div class="modal fade" id="modalDelete{{ $data->uuid }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                        aria-labelledby="modalTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="modalTitleId">
                                                        Hapus Pengajuan Magang
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin ingin menghapus pengajuan magang di divisi
                                                        {{ $data->division->name }} ini?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <form action="{{ route('interns.destroy', $data->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    @endif
                @endrole
            </table>
        </div>
    </div>
@endsection
