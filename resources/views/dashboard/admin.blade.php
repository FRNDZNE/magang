@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('page-active', 'active')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-dark shadow-sm">
                    <i class="bi bi-diagram-3"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Divisi</span>
                    <span class="info-box-number">
                        {{ $data['division'] }}
                        <small>Divisi</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-secondary shadow-sm">
                    <i class="bi bi-person-badge"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Mentor</span>
                    <span class="info-box-number">
                        {{ $data['mentor'] }}
                        <small>Mentor</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-info shadow-sm">
                    <i class="bi bi-people"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Mahasiswa Te-registrasi</span>
                    <span class="info-box-number">
                        {{ $data['student'] }}
                        <small>Mahasiswa</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-primary shadow-sm">
                    <i class="bi bi-card-checklist"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Pengajuan</span>
                    <span class="info-box-number">
                        {{ $data['total_pengajuan'] }}
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
                <span class="info-box-icon text-bg-info shadow-sm">
                    <i class="bi bi-hourglass-split"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Pengajuan Masuk</span>
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
                    <span class="info-box-text">Pengajuan di Proses</span>
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
                    <span class="info-box-text">Pengajuan Diterima</span>
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
@endsection
