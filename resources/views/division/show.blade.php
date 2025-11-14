@extends('layouts.app')
@section('title', 'Manajemen Divisi')
@section('role', 'Nanti ada role disini')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Detail Divisi</li>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detail Divisi</h3>
    </div>
    <div class="card-body">
        <p>
            <strong>Nama Divisi : </strong> {{ $division->name }}
        </p>
        <p>
            <strong>Deskripsi : </strong> {{ $division->description }}
        </p>
    </div>
    <div class="card-footer">
        <a href="{{ route('divisions.index') }}" class="btn btn-secondary btn-md">Kembali</a>
    </div>
</div>
@endsection

