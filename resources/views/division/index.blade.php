@extends('layouts.app')
@section('title', 'Manajemen Divisi')
@section('role', 'Nanti ada role disini')                                                                                              .
@section('page-active', 'active')
@section('content')

<div class="card mb-4">
    <div class="card-header"><h3 class="card-title">Tabel Divisi</h3></div>
    <!-- /.card-header -->
    <div class="card-body">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th style="width: 10px">No</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th style="width: 40px">Aksi</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $division)
                <tr class="align-middle">
                    <td>{{ $index + 1 }}.</td>
                    <td>{{ $division->name }}</td>
                    <td>{{ $division->description }}</td>
                    <td>
                        <a href="{{ route('divisions.edit', $division->id) }}" class="btn btn-sm btn-primary mb-1">Edit</a>
                        <form action="{{ route('divisions.destroy', $division->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Are you sure you want to delete this division?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <!-- /.card-body -->
</div>
@endsection
