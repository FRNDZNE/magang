@extends('layouts.app')
@section('title', 'Logbook')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('page-active', 'active')
@section('breadcrumb')
    <li class="breadcrumb-item active">Tambah Logbook Magang</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Logbook Magang</h3>
        </div>
        <form action="{{ route('interns.logbooks.store', $intern->uuid) }}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group m-3">
                    <label for="date">Tanggal</label>
                    <input type="date" name="date" id="date"
                        class="form-control @error('date') is-invalid @else @if (old('date')) is-valid @endif @enderror"
                        value="{{ old('date') }}">
                    @error('date')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @else
                        @if (old('date'))
                            <span class="valid-feedback">Sudah Diisi</span>
                        @endif
                    @enderror
                </div>
                <div class="form-group m-3">
                    <label for="activity">Aktivitas</label>
                    <textarea name="activity" id="activity" cols="30" rows="3"
                        class="form-control @error('activity') is-invalid @else @if (old('activity')) is-valid @endif @enderror">{{ old('activity') }}</textarea>
                    @error('activity')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @else
                        @if (old('activity'))
                            <span class="valid-feedback">Sudah Diisi</span>
                        @endif
                    @enderror
                </div>
                <div class="form-group m-3">
                    <label for="output">Hasil</label>
                    <textarea name="output" id="output" cols="30" rows="3"
                        class="form-control @error('output') is-invalid @else @if (old('output')) is-valid @endif @enderror">{{ old('output') }}</textarea>
                    @error('output')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @else
                        @if (old('output'))
                            <span class="valid-feedback">Sudah Diisi</span>
                        @endif
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('interns.logbooks.index', $intern->uuid) }}" class="btn btn-md btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-md btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection
