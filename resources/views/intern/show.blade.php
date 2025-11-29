@extends('layouts.app')
@section('title', 'Pengajuan Magang')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('breadcrumb')
    <li class="breadcrumb-item active">Detail Pengajuan Magang</li>
@endsection
@section('content')
    <a href="{{ route('interns.index') }}" class="btn btn-md btn-secondary">Kembali</a>
    <hr>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $intern->student->user->name }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <p><strong>Nama:</strong> {{ $intern->student->institution }}</p>
                    <p><strong>Divisi yang Dituju:</strong> {{ $intern->division->name }}</p>
                    <p><strong>Tanggal Mulai Magang:</strong> {{ $intern->start_date }}</p>
                    <p><strong>Tanggal Selesai Magang:</strong> {{ $intern->end_date }}</p>
                    <p><strong>Status Pengajuan:</strong>
                        @if ($intern->status == 'c')
                            @if ($intern->deleted_at)
                                <span class="badge bg-secondary">Dibatalkan</span>
                            @else
                                <span class="badge bg-primary">Terkonfirmasi</span>
                            @endif
                        @elseif($intern->status == 'p')
                            <span class="badge bg-warning">Dalam Proses</span>
                        @elseif($intern->status == 'a')
                            <span class="badge bg-success">Diterima</span>
                        @elseif($intern->status == 'd')
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            @if ($intern->status == 'c')
                <!-- Modal trigger button -->
                <button type="button" class="btn btn-warning btn-md" data-bs-toggle="modal" data-bs-target="#modalproses">
                    Proses
                </button>

                <!-- Modal Body -->
                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                <div class="modal fade" id="modalproses" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
                    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitleId">
                                    Proses Pengajuan Magang
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>
                                    Apakah anda yakin ingin memproses pengajuan magang
                                    <strong>{{ $intern->student->user->name }}</strong>?
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <form action="{{ route('interns.process', $intern->uuid) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-md btn-warning">Proses</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if ($intern->status == 'p')
                {{-- Modal Tolak --}}
                <!-- Modal trigger button -->
                <button type="button" class="btn btn-danger btn-md" data-bs-toggle="modal" data-bs-target="#modalId">
                    Tolak
                </button>

                <!-- Modal Body -->
                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
                    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitleId">
                                    Tolak Pengajuan Magang
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>
                                    Apakah anda yakin ingin menolak pengajuan magang
                                    <strong>{{ $intern->student->user->name }}</strong>?
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <form action="{{ route('interns.denied', $intern->uuid) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Tolak</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Modal Tolak --}}
                {{-- Modal Terima --}}
                <!-- Modal trigger button -->
                <button type="button" class="btn btn-success btn-md" data-bs-toggle="modal" data-bs-target="#modalTerima">
                    Terima
                </button>

                <!-- Modal Body -->
                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                <div class="modal fade" id="modalTerima" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
                    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitleId">
                                    Terima Pengajuan Magang
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('interns.accept', $intern->uuid) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <p>Jika menerima pengajuan magang, silahkan pilih mentor untuk siswa/mahasiswa magang
                                        bersangkutan</p>
                                    <div class="mb-3">
                                        <label for="mentor_id" class="form-label">Pilih Mentor</label>
                                        <select class="form-select" name="mentor_id" id="mentor_id" required>
                                            <option value="" selected disabled>-- Pilih Mentor --</option>
                                            @foreach ($mentors as $m)
                                                <option value="{{ $m->id }}">
                                                    {{ $m->user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="submit" class="btn btn-success">Terima</button>
                                </div>
                            </form>
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

                {{-- End Modal Terima --}}
            @endif
        </div>
    </div>
@endsection
