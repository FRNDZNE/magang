@extends('layouts.app')
@section('title', 'History Pengajuan Magang')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('page-active', 'active')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">History Pengajuan Magang</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Divisi Tujuan</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->division->name }}</td>
                            <td>{{ $d->start_date }}</td>
                            <td>{{ $d->end_date }}</td>
                            <td>
                                @if ($d->status == 'c')
                                    @if ($d->deleted_at)
                                        <span class="badge bg-secondary">Dibatalkan</span>
                                    @else
                                        <span class="badge bg-primary">Terkonfirmasi</span>
                                    @endif
                                @elseif($d->status == 'p')
                                    <span class="badge bg-warning">Dalam Proses</span>
                                @elseif($d->status == 'a')
                                    <span class="badge bg-success">Diterima</span>
                                @elseif($d->status == 'd')
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
            </table>
        </div>
    </div>
@endsection
