@extends('layouts.app')
@section('title', 'Manajemen Penilaian')
@section('role', 'Nanti ada role disini')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Detail Aspek Penialaian</li>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detail Aspek Penilaian</h3>
    </div>
    <div class="card-body">
        <p>
            <strong>Aspek Penilaian : </strong> {{ $score->name }}
        </p>
        <p>
            <strong>Keterangan : </strong> {{ $score->description }}
        </p>
    </div>
    <div class="card-footer">
        <a href="{{ route('scores.index') }}" class="btn btn-secondary btn-md">Kembali</a>
    </div>
</div>
@endsection

