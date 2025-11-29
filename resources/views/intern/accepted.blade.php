@extends('layouts.app')
@section('title', 'Magang')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('page-active', 'active')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Magang</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Asal Institusi</th>
                        <th>Divisi Tujuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @foreach ($data as $d)
                    <tbody>
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->student->user->name }}</td>
                            <td>{{ $d->student->institution }}</td>
                            <td>{{ $d->student->intern->division->name }}</td>
                            <td>
                                <a href="{{ route('interns.show', $d->uuid) }}" class="btn btn-info btn-md">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
        <div class="card-footer">
            {{ $data->links() }}
        </div>
    </div>
@endsection
