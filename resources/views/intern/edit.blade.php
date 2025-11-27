@extends('layouts.app')
@section('title', 'Manajemen Magang')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('page-active', 'active')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Masukan Pengajuan Magang</h3>
        </div>
        <form action="{{ route('interns.update', $) }}" method="post">
            @csrf
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="division">Divisi</label>
                            <select name="division_id" id="division"
                                class="form-control @error('division_id') is-invalid @elseif(old('division_id')) is-valid @enderror">
                                <option value="">Pilih Divisi</option>
                                @foreach ($divisions as $d)
                                    <option value="{{ $d->id }}"
                                        {{ $intern->division_id == $d->id ? 'selected' : '' }}>
                                        {{ $d->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('division_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_date">Tanggal Mulai</label>
                            <input type="date" name="start_date" id="start_date"
                                class="form-control @error('start_date') is-invalid @else @if (old('start_date')) is-valid @endif @enderror"
                                value="{{ $intern->start_date }}">
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_date">Tanggal Selesai</label>
                            <input type="date" name="end_date" id="end_date"
                                class="form-control @error('end_date') is-invalid @else @if (old('end_date')) is-valid @endif @enderror"
                                value="{{ $intern->end_date }}">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
