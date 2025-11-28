@extends('layouts.app')
@section('title', 'Dashboard Mentee')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('page-active', 'active')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="info-box">
                <span class="info-box-icon text-bg-info shadow-sm">
                    <i class="bi bi-card-checklist"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Jumlah Pengajuan</span>
                    <span class="info-box-number">
                        0
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
                    <i class="bi bi-card-checklist"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Pengajuan Terkonfirmasi</span>
                    <span class="info-box-number">
                        0
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
                        0
                        <small>Orang</small>
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
                    <span class="info-box-text">Pengjauan Diterima</span>
                    <span class="info-box-number">
                        0
                        <small>Orang</small>
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
                        0
                        <small>Orang</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Magang</h3>
                </div>
                <div class="card-body">
                    <p><b>Divisi Tujuan :</b> </p>
                    <p><b>Mentor :</b> </p>
                    <p><b>Nomor Pegawai :</b> </p>
                    <p><b>Kontak :</b> <a href="">Nomor Mentor Disini</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
