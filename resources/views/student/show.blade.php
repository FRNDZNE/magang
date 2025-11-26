@extends('layouts.app')
@section('title', 'Manajemen Student')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('breadcrumb')
    <li class="breadcrumb-item active">Detail Student</li>
@endsection
@section('content')
    <a href="{{ route('students.index') }}" class="btn btn-md btn-secondary">Kembali</a>
    <hr>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $student->user->name }}</h3>
        </div>
        <div class="card-body">
            <p><strong>NIM/NISN : </strong> {{ $student->student_number }}</p>
            <p><strong>Jurusan : </strong> {{ $student->major }}</p>
            <p><strong>Institusi : </strong> {{ $student->institution }}</p>
            <p></p><strong>Nama Lengkap : </strong> {{ $student->user->name }}</p>
            <p><strong>Nomor Telepon : </strong> <a href="https://wa.me/{{ $student->phone }}"
                    target="_blank">{{ $student->phone }}</a></p>
            <p><strong>Email : </strong> {{ $student->user->email }}</p>
            <p><strong>Alamat : </strong> {{ $student->address }}</p>
        </div>
    </div>
@endsection
