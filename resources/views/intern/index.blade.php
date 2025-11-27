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
                <a href="{{ route('interns.create') }}" class="btn btn-primary mb-3">
                    <i class="bi bi-plus-lg"></i> Ajukan Magang
                </a>
            @endrole

            <hr>
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
                    <tbody>

                    </tbody>
                @endrole
            </table>
        </div>
    </div>
@endsection
