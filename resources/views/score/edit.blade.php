@extends('layouts.app')
@section('title', 'Manajemen Penilaian')
@section('role', 'Nanti ada role disini')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Edit Aspek Penilaian</li>
@endsection
@section('content')
<div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Edit Aspek Penilaian</h3>
        </div>
        <form action="{{ route('scores.update', $score->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Aspek Penialaian</label>
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @else @if (old('name')) is-valid @endif @enderror"
                        value="{{ $score->name }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        @if (old('name'))
                            <div class="valid-feedback">Sudah Di isi</div>
                        @endif
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Keaterangan</label>
                    <textarea name="description"  class="form-control @error('description') is-invalid @else @if (old('description')) is-valid @endif @enderror" id="description" cols="30" rows="10">{{$score->description ?? ''}}</textarea>
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
                <a href="{{ route('scores.index') }}" class="btn btn-secondary btn-md">Kembali</a>
                <button type="submit" class="btn btn-warning btn-md">Update</button>
            </div>
        </form>
    </div>
@endsection

