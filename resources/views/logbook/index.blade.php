@extends('layouts.app')
@section('title', 'Logbook')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('page-active', 'active')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Logbook Magang</h3>
        </div>
        <div class="card-body">
            @role('student')
                <a href="{{ route('interns.logbooks.create', $intern->uuid) }}" class="btn btn-md btn-primary"><i
                        class="bi bi-plus"></i> Tambah Logbook</a>
            @endrole
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logbooks as $log)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $log->date }}</td>
                                <td>
                                    <a href="{{ route('interns.logbooks.show', [$intern->uuid, $log->id]) }}"
                                        class="btn btn-md btn-info"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('interns.logbooks.edit', [$intern->uuid, $log->id]) }}"
                                        class="btn btn-md btn-warning"><i class="bi bi-pencil"></i></a>
                                    {{-- Modal Delete --}}
                                    <!-- Modal trigger button -->
                                    <button type="button" class="btn btn-danger btn-md" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete-{{ $log->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                    <!-- Modal Body -->
                                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                    <div class="modal fade" id="modalDelete-{{ $log->id }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                        aria-labelledby="modalTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTitleId">
                                                        Hapus Logbook
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Ingin Menghapus Logbook Tanggal {{ $log->date }} ? </p>
                                                    <p>Menghapus Logbook juga menghapus dokumentasi yang ada didalamnya.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <form
                                                        action="{{ route('interns.logbooks.destroy', [$intern->uuid, $log->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

        </div>
        @role('mentor|admin')
            <div class="card-footer">
                <a href="{{ route('interns.show', $intern->uuid) }}" class="btn btn-secondary btn-md">Kembali</a>
            </div>
        @endrole
    </div>
@endsection
