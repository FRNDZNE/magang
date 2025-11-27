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
                                    <a href="{{ route('interns.show', $d->uuid) }}" class="btn btn-info btn-sm">
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
                                <td>{{ $data->start_date }}</td>
                                <td>{{ $data->end_date }}</td>
                                <td>
                                    <a href="{{ route('interns.show', $data->uuid) }}" class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    @endif

                @endrole
            </table>
        </div>
    </div>
@endsection
