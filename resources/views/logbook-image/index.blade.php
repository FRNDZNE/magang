@extends('layouts.app')
@section('title', 'Dokumentasi Tanggal ' . $logbook->date)
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('page-active', 'active')
@section('breadcrumb')
    <li class="breadcrumb-item active">Dokumentasi</li>
@endsection
@section('content')
    <a href="{{ route('interns.logbooks.show', [$intern->uuid, $logbook->id]) }}" class="btn btn-md btn-secondary">Kembali</a>
    <!-- Modal trigger button -->
    <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#modalCreate">
        <i class="bi bi-plus"></i> Tambah Gambar
    </button>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="modalCreate" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Tambah Gambar
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('interns.logbooks.images.store', [$intern->uuid, $logbook->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="image">Gambar</label>
                            <input type="file" name="image" id="image"
                                class="form-control @error('image') is-invalid @enderror" accept="image/*">
                            @error('image')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($images as $img)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ asset($img->image_path) }}" alt="Gambar Rusak">
                        </td>
                        <td>
                            {{-- Modal Edit --}}
                            <!-- Modal trigger button -->
                            <button type="button" class="btn btn-warning btn-md" data-bs-toggle="modal"
                                data-bs-target="#modalEdit-{{ $img->id }}">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <!-- Modal Body -->
                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                            <div class="modal fade" id="modalEdit-{{ $img->id }}" tabindex="-1"
                                data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                aria-labelledby="modalTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitleId">
                                                Edit Gambar
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form
                                            action="{{ route('interns.logbooks.images.update', [$intern->uuid, $logbook->id, $img->id]) }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="image">Gambar</label>
                                                    <input type="file" name="image" id="image"
                                                        class="form-control @error('image') is-invalid @enderror"
                                                        accept="image/*">
                                                    @error('image')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-warning">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal Edit --}}
                            {{-- Modal Delete --}}
                            <!-- Modal trigger button -->
                            <button type="button" class="btn btn-danger btn-md" data-bs-toggle="modal"
                                data-bs-target="#modalDelete-{{ $img->id }}">
                                <i class="bi bi-trash"></i>
                            </button>

                            <!-- Modal Body -->
                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                            <div class="modal fade" id="modalDelete-{{ $img->id }}" tabindex="-1"
                                data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                aria-labelledby="modalTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitleId">
                                                Hapus Gambar
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Ingin Hapus Gambar ini ?</p>
                                            <img src="{{ asset($img->image_path) }}" alt="Gambar Rusak">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <form
                                                action="{{ route('interns.logbooks.images.destroy', [$intern->uuid, $logbook->id, $img->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Optional: Place to the bottom of scripts -->
                            <script>
                                const myModal = new bootstrap.Modal(
                                    document.getElementById("modalId"),
                                    options,
                                );
                            </script>

                            {{-- End Modal Delete --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" align="center">Tidak Ada Data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


@endsection
