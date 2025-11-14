@extends('layouts.app')
@section('title', 'Manajemen Divisi')
@section('role', 'Nanti ada role disini')
@section('page-active', 'active')
@section('content')
<div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Tambah Divisi</h3>
        </div>
        <form action="{{ route('divisions.store') }}" method="post">
            <div class="card-body">
                @csrf
                <div class="form-group">
                    <label for="name">Nama Divisi</label>
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @else @if (old('name')) is-valid @endif @enderror"
                        value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        @if (old('name'))
                            <div class="valid-feedback">Sudah Di isi</div>
                        @endif
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea name="description"  class="form-control @error('description') is-invalid @else @if (old('description')) is-valid @endif @enderror" id="description" cols="30" rows="10">{{old('description')}}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        @if (old('description'))
                            <div class="valid-feedback">Sudah Di isi</div>
                        @endif
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('divisions.index') }}" class="btn btn-secondary btn-md">Kembali</a>
                <button type="submit" class="btn btn-primary btn-md">Tambah</button>
            </div>
        </form>
    </div>
@endsection

