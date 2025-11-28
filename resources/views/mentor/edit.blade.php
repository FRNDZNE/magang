@extends('layouts.app')
@section('title', 'Manajemen Mentor')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('breadcrumb')
    <li class="breadcrumb-item active">Edit Mentor</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Edit Mentor</h3>
        </div>
        <form action="{{ route('mentors.update', $user->uuid) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="division">Divisi</label>
                            <select name="division_id" id="division"
                                class="form-control @error('division_id') is-invalid @elseif($mentor->division_id) is-valid @enderror">
                                <option value="">Pilih Divisi</option>
                                @foreach ($divisions as $d)
                                    <option value="{{ $d->id }}"
                                        {{ $mentor->division_id == $d->id ? 'selected' : '' }}>
                                        {{ $d->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('division_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @elseif(old('division_id'))
                                <div class="valid-feedback">Sudah dipilih</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="employee_number">Nomor Registrasi Pegawai</label>
                            <input type="text" name="employee_number" id="employee_number"
                                class="form-control @error('employee_number') is-invalid @else @if (old('employee_number')) is-valid @endif @enderror"
                                value="{{ $mentor->employee_number }}">
                            @error('employee_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                @if (old('employee_number'))
                                    <div class="valid-feedback">Sudah Di isi</div>
                                @endif
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @else @if (old('name')) is-valid @endif @enderror"
                                value="{{ $mentor->user->name }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                @if (old('name'))
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
                                value="{{ $mentor->user->email }}">
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
                            <label for="phone">Nomor Telepon</label>
                            <input type="text" name="phone" id="phone"
                                class="form-control @error('phone') is-invalid @else @if (old('phone')) is-valid @endif @enderror"
                                value="{{ $mentor->phone }}">
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
            </div>
            <div class="card-footer">
                <a href="{{ route('mentors.index') }}" class="btn btn-secondary btn-md">Kembali</a>
                <button type="submit" class="btn btn-warning btn-md">Update</button>
            </div>
        </form>
    </div>
@endsection
