@extends('layouts.app')
@section('title', 'Pengajuan Magang')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('breadcrumb')
    <li class="breadcrumb-item active">Detail Magang</li>
@endsection
@section('content')
    <a href="{{ route('interns.index') }}" class="btn btn-md btn-secondary">Kembali</a>
    <hr>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"></h3>
        </div>
        <div class="card-body">

        </div>
    </div>
    <hr>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Anak Bimbingan</h3>
        </div>
        <div class="card-body">

        </div>
    </div>
@endsection
