@extends('layouts.app')
@section('title', 'Manajemen Student')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('breadcrumb')
    <li class="breadcrumb-item active">Edit Student</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Edit Student</h3>
        </div>
        <form action="{{ route('students.update', $student->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="student_number">NIM/NISN</label>
                            <input type="text" name="student_number" id="student_number"
                                class="form-control @error('student_number') is-invalid @else @if (old('student_number')) is-valid @endif @enderror"
                                value="{{ $student->student_number }}">
                            @error('student_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                @if (old('student_number'))
                                    <div class="valid-feedback">Sudah Di isi</div>
                                @endif
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="major">Jurusan</label>
                            <input type="text" name="major" id="major"
                                class="form-control @error('major') is-invalid @else @if (old('major')) is-valid @endif @enderror"
                                value="{{ $student->major }}">
                            @error('major')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                @if (old('major'))
                                    <div class="valid-feedback">Sudah Di isi</div>
                                @endif
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="institution">Institusi</label>
                            <input type="text" name="institution" id="institution"
                                class="form-control @error('institution') is-invalid @else @if (old('institution')) is-valid @endif @enderror"
                                value="{{ $student->institution }}">
                            @error('institution')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                @if (old('institution'))
                                    <div class="valid-feedback">Sudah Di isi</div>
                                @endif
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @else @if (old('name')) is-valid @endif @enderror"
                                value="{{ $student->user->name }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                @if (old('name'))
                                    <div class="valid-feedback">Sudah Di isi</div>
                                @endif
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Nomor Telepon</label>
                            <input type="text" name="phone" id="phone"
                                class="form-control @error('phone') is-invalid @else @if (old('phone')) is-valid @endif @enderror"
                                value="{{ $student->phone }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                @if (old('phone'))
                                    <div class="valid-feedback">Sudah Di isi</div>
                                @endif
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">E-Mail</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @else @if (old('email')) is-valid @endif @enderror"
                                value="{{ $student->user->email }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                @if (old('email'))
                                    <div class="valid-feedback">Valid</div>
                                @endif
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @else @if (old('password')) is-valid @endif @enderror">
                            <span>Abaikan Jika Tidak Ingin Mengganti Password</span>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                @if (old('password'))
                                    <div class="valid-feedback">Valid</div>
                                @endif
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea name="address" id="address" rows="5"
                                class="form-control @error('address') is-invalid @else @if (old('address')) is-valid @endif @enderror">{{ old('address', $student->address) }}</textarea>

                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                @if (old('address'))
                                    <div class="valid-feedback">Sudah Di isi</div>
                                @endif
                            @enderror
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <a href="{{ route('students.index') }}" class="btn btn-secondary btn-md">Kembali</a>
                <button type="submit" class="btn btn-warning btn-md">Update</button>
            </div>
        </form>
    </div>
@endsection
