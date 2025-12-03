@extends('layouts.app')
@section('title', 'Penilaian')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('page-active', 'active')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Penilaian Magang</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Penilaian</th>
                            <th scope="col">Nilai</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['score'] as $score)
                            @php
                                $nilai = $data['score_value']->firstWhere('score_id', $score->id);
                            @endphp
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $score->name }}</td>
                                <td>{{ $nilai->value ?? 'N/A' }}</td>
                                <td>
                                    <!-- Modal trigger button -->
                                    <button type="button" class="btn btn-info btn-md" data-bs-toggle="modal"
                                        data-bs-target="#modalScore-{{ $score->id }}">
                                        Masukan Nilai
                                    </button>

                                    <!-- Modal Body -->
                                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                    <div class="modal fade" id="modalScore-{{ $score->id }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                        aria-labelledby="modalTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTitleId">
                                                        Penilaian {{ $score->name }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('interns.score-values.store', $intern->uuid) }}"
                                                    method="post">
                                                    @csrf
                                                    @if ($nilai != null)
                                                        <input type="hidden" name="id" value="{{ $nilai->id }}">
                                                    @endif
                                                    <input type="hidden" name="score_id" value="{{ $score->id }}">
                                                    <div class="modal-body">
                                                        <div class="form-group ">
                                                            <label for="description">Deskripsi Penilaian</label>
                                                            <textarea disabled name= "description" id="description" cols="30" rows="5" class="form-control">{{ $score->description }}</textarea>
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <div class="form-group">
                                                                <label for="value">Nilai</label>
                                                                <input type="number" name="value" id="value"
                                                                    class="form-control @error('value') is-invalid @enderror"
                                                                    value="{{ $nilai->value ?? old('value') }}"
                                                                    min="0">
                                                                @error('value')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                            Close
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
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

                                </td>
                            </tr>
                        @endforeach
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
