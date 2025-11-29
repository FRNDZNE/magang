@extends('layouts.app')
@section('title', 'Dashboard Mentor')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('page-active', 'active')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="info-box">
                <span class="info-box-icon text-bg-primary shadow-sm">
                    <i class="bi bi-people"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Mentee</span>
                    <span class="info-box-number">
                        {{ $data['mentee']->count() }}
                        <small>Orang</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Asal Institusi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data['mentee'] as $mentee)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $mentee->student->user->name }}</td>
                        <td>{{ $mentee->student->institution }}</td>
                        <td>
                            <a href="{{ route('interns.show', $mentee->uuid) }}" class="btn btn-md btn-info">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Belum Ada Anak Bimbingan</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

@endsection
