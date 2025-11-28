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
            <h3 class="card-title">{{ $student->name }}</h3>
        </div>
        <div class="card-body">
            <p><strong>NIM/NISN : </strong> {{ $student->student->student_number }}</p>
            <p><strong>Jurusan : </strong> {{ $student->student->major }}</p>
            <p><strong>Institusi : </strong> {{ $student->student->institution }}</p>
            <p></p><strong>Nama Lengkap : </strong> {{ $student->name }}</p>
            <p><strong>Nomor Telepon : </strong> <a href="https://wa.me/{{ $student->student->phone }}"
                    target="_blank">{{ $student->student->phone }}</a></p>
            <p><strong>Email : </strong> {{ $student->email }}</p>
            <p><strong>Alamat : </strong> {{ $student->student->address }}</p>
        </div>
    </div>
@endsection
