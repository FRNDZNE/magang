@extends('layouts.app')
@section('title', 'Managemen Permission')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('page-active', 'active')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Managemen Permission</h3>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#createPermission">
                <i class="bi bi-plus"></i> Tambah Permission
            </button>
            <div class="modal fade" id="createPermission" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
                role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="modalTitleId">
                                Tambah Permission
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('permissions.store') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Nama Permission</label>
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
                                    <label for="guard_name">Guard</label>
                                    <input type="text" name="guard_name" id="guard_name"
                                        class="form-control @error('guard_name') is-invalid @else @if (old('guard_name')) is-valid @endif @enderror"
                                        value="{{ old('guard_name') }}">
                                    @error('guard_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        @if (old('guard_name'))
                                            <div class="valid-feedback">Sudah Di isi</div>
                                        @endif
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit"class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th style="width: 10px">No</th>
                        <th>Nama Permission</th>
                        <th>Display</th>
                        <th style="width: 200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->guard_name }}</td>
                            <td>
                                <!-- Modal Edit -->
                                <button type="button" class="btn btn-warning btn-md" data-bs-toggle="modal"
                                    data-bs-target="#modalEdit-{{ $p->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                <!-- Modal Body Edit -->
                                <div class="modal fade" id="modalEdit-{{ $p->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning">
                                                <h5 class="modal-title" id="modalTitleId">
                                                    Edit Permission
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('permissions.update', $p->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="name">Nama Permission</label>
                                                        <input type="text" name="name" id="name"
                                                            class="form-control @error('name') is-invalid @else @if (old('name')) is-valid @endif @enderror"
                                                            value="{{ $p->name }}">
                                                        @error('name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @else
                                                            @if (old('name'))
                                                                <div class="valid-feedback">Sudah Di isi</div>
                                                            @endif
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="guard_name">Display</label>
                                                        <input type="text" name="guard_name" id="guard_name"
                                                            class="form-control @error('guard_name') is-invalid @else @if (old('guard_name')) is-valid @endif @enderror"
                                                            value="{{ $p->guard_name }}">
                                                        @error('guard_name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @else
                                                            @if (old('guard_name'))
                                                                <div class="valid-feedback">Sudah Di isi</div>
                                                            @endif
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="submit"class="btn btn-warning">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal trigger button -->
                                <button type="button" class="btn btn-danger btn-md" data-bs-toggle="modal"
                                    data-bs-target="#modalDelete-{{ $p->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="modalDelete-{{ $p->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h5 class="modal-title text-white" id="modalTitleId">
                                                    Hapus Permission
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Hapus Permission {{ $p->guard_name }} dari Daftar Permission ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <form action="{{ route('permissions.destroy', $p->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        <div class="card-footer">
            {{ $permissions->links() }}
        </div>
    </div>



@endsection
