@extends('layouts.app')
@section('title', 'Manajemen Magang')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('page-active', 'active')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Masukan Pengajuan Magang</h3>
        </div>
        <form action="{{ route('interns.store') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="division">Divisi Tujuan</label>
                            <select name="" id="" class="form-control">
                                <option value="">-- Pilih Divisi --</option>
                                @foreach ($divisions as $d)
                                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="end_date" class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('interns.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Ajukan</button>
            </div>
        </form>
    </div>
@endsection
