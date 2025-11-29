@extends('layouts.app')
@section('title', 'Dashboard Mentee')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('page-active', 'active')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="info-box">
                <span class="info-box-icon text-bg-info shadow-sm">
                    <i class="bi bi-card-checklist"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Jumlah Pengajuan</span>
                    <span class="info-box-number">
                        {{ $data['pengajuan'] }}
                        <small>Pengajuan</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="info-box">
                <span class="info-box-icon text-bg-dark shadow-sm">
                    <i class="bi bi-x-octagon-fill"></i>

                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Pengajuan Dibatalkan</span>
                    <span class="info-box-number">
                        {{ $data['dibatalkan'] }}
                        <small>Pengajuan</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-primary shadow-sm">
                    <i class="bi bi-hourglass-split"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Pengajuan Terkonfirmasi</span>
                    <span class="info-box-number">
                        {{ $data['terkonfirmasi'] }}
                        <small>Pengajuan</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-warning shadow-sm">
                    <i class="bi bi-inbox"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Pengajuan diproses</span>
                    <span class="info-box-number">
                        {{ $data['process'] }}
                        <small>Pengajuan</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-success shadow-sm">
                    <i class="bi bi-check-circle"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Pengajauan Diterima</span>
                    <span class="info-box-number">
                        {{ $data['accepted'] }}
                        <small>Pengajuan</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-danger shadow-sm">
                    <i class="bi bi-x-circle"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Pengajuan Ditolak</span>
                    <span class="info-box-number">
                        {{ $data['denied'] }}
                        <small>Pengajuan</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Magang</h3>
                </div>
                <div class="card-body">
                    <p><b>Divisi Tujuan :</b> {{ $data['internship']->division->name ?? 'Belum Mengajukan' }}</p>
                    <p><b>Mentor :</b> {{ $data['internship']->mentor->user->name ?? 'Belum Ditentukan' }}</p>
                    <p><b>Nomor Pegawai :</b> {{ $data['internship']->mentor->employee_number ?? 'Belum Ditentukan' }}</p>
                    <p><b>Kontak :</b> <a
                            href="https://wa.me/{{ $data['internship']->mentor->phone ?? 'Belum Ditentukan' }}">{{ $data['internship']->mentor->phone ?? 'Belum Ditentukan' }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Penilaian</h3>
                </div>

                <div class="card-body">

                    @if ($data['score']->isEmpty())
                        <p>Belum ada penilaian.</p>
                    @else
                        @foreach ($data['score'] as $item)
                            <div class="mb-2">
                                <strong>{{ $item->name }} :</strong>
                                {{ $data['my_score'][$item->id]->value ?? 'N/A' }}
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>


@endsection
