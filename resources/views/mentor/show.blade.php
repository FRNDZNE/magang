@extends('layouts.app')
@section('title', 'Manajemen Mentor')
@section('role', 'Nanti ada role disini')
@section('breadcrumb')
    <li class="breadcrumb-item active">Detail Mentor</li>
@endsection
@section('content')
    <a href="{{ route('mentors.index') }}" class="btn btn-md btn-secondary">Kembali</a>
    <hr>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $mentor->user->name }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Nomor Registrasi Pegawai : </strong> {{ $mentor->employee_number }}</p>
            <p><strong>Nama : </strong> {{ $mentor->user->name }}</p>
            <p><strong>Email : </strong> {{ $mentor->user->email }}</p>
            <p><strong>Nomor Telepon : </strong> <a href="https://wa.me/{{ $mentor->phone }}"
                    target="_blank">{{ $mentor->phone }}</a></p>
            <p><strong>Divisi : </strong> {{ $mentor->division->name }}</p>
        </div>
    </div>
    <hr>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Anak Bimbingan</h3>
        </div>
        <div class="card-body">
            Soon YA
        </div>
    </div>
@endsection
