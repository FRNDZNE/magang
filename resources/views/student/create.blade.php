@extends('layouts.app')
@section('title', 'Manajemen Student')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('breadcrumb')
    <li class="breadcrumb-item active">Tambah Student</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Tambah Student</h3>
        </div>
        <form action="{{ route('students.store') }}" method="post">
            <div class="card-body">
                @csrf
               <div class="row">
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <input type="text" name="student_number"
                                    class="form-control @error('student_number') is-invalid @elseif(old('student_number')) is-valid @enderror"
                                    value="{{ old('student_number') }}" placeholder="NIM/NIS/NISN" />

                                @error('student_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group mb-3">
                                <input type="text" name="major"
                                    class="form-control @error('major') is-invalid @elseif(old('major')) is-valid @enderror"
                                    value="{{ old('major') }}" placeholder="Jurusan" />
                                @error('major')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" name="institution"
                            class="form-control @error('institution') is-invalid @elseif(old('institution')) is-valid @enderror"
                            value="{{ old('institution') }}" placeholder="Asal Sekolah / Perguruan Tinggi" />
                        @error('institution')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" name="name"
                            class="form-control @error('name') is-invalid @elseif(old('name')) is-valid @enderror"
                            value="{{ old('name') }}" placeholder="Nama Lengkap" />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @elseif(old('email')) is-valid @enderror"
                                    value="{{ old('email') }}" placeholder="E-mail" />
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="number" name="phone"
                                    class="form-control @error('phone') is-invalid @elseif(old('phone')) is-valid @enderror"
                                    value="{{ old('phone') }}" placeholder="Nomor Telepon" min="0" />
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Password" />
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="input-group mb-3">
                                <textarea name="address" rows="6"
                                    class="form-control @error('address') is-invalid @elseif(old('address')) is-valid @enderror"
                                    placeholder="Alamat">{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('mentors.index') }}" class="btn btn-secondary btn-md">Kembali</a>
                <button type="submit" class="btn btn-primary btn-md">Tambah</button>
            </div>
        </form>
    </div>
@endsection
