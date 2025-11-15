@extends('layouts.app')
@section('title', 'Manajemen Divisi')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('page-active', 'active')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tabel Divisi</h3>
        </div>
        <div class="card-body">
            <a href="{{ route('divisions.create') }}" class="btn btn-primary mb-3">
                <i class="bi bi-plus-lg"></i> Tambah Divisi
            </a>

            <hr>
            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th style="width: 10px">No</th>
                        <th>Nama Divisi</th>
                        <th>Deskripsi</th>
                        <th style="width: 200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($division as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->description }}</td>
                            <td>
                                {{-- Button Detail --}}
                                <a href="{{ route('divisions.show', $d->id) }}" class="btn btn-md btn-info"><i class="bi bi-eye"></i></a>
                                {{-- End Button Detail --}}

                                {{-- Button Edit --}}
                                <a href="{{ route('divisions.edit', $d->id) }}" class="btn btn-md btn-warning"><i class="bi bi-pencil-square"></i></a>
                                {{-- End Button Edit --}}

                                {{-- Button Hapus --}}
                                <!-- Modal trigger button -->
                                <button
                                    type="button"
                                    class="btn btn-danger btn-md-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalId-{{ $d->id }}"
                                >
                                    <i class="bi bi-trash"></i>
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div
                                    class="modal fade"
                                    id="modalId-{{ $d->id }}"
                                    tabindex="-1"
                                    data-bs-backdrop="static"
                                    data-bs-keyboard="false"

                                    role="dialog"
                                    aria-labelledby="modalTitleId"
                                    aria-hidden="true"
                                >
                                    <div
                                        class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                                        role="document"
                                    >
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h5 class="modal-title text-white" id="modalTitleId">
                                                    Hapus Divisi
                                                </h5>
                                                <button
                                                    type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close"
                                                ></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Anda Yakin Hapus {{$d->name}} dari Divisi ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    data-bs-dismiss="modal"
                                                >
                                                    Kembali
                                                </button>
                                                <form action="{{ route('divisions.destroy', $d->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Button Hapus --}}

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak Ada Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>



@endsection
