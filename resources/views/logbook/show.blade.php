@extends('layouts.app')
@section('title', 'Logbook')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('page-active', 'active')
@section('breadcrumb')
    <li class="breadcrumb-item active">Detail Logbook Magang</li>
@endsection
@section('content')
    <a href="{{ route('interns.logbooks.index', $intern->uuid) }}" class="btn btn-md btn-secondary">Kembali</a>
    <a href="{{ route('interns.logbooks.images.index', [$intern->uuid, $logbook->id]) }}" class="btn btn-md btn-dark">Masukan
        Gambar</a>
    <hr>
    <div class="card m-3">
        <div class="card-header">
            <h3 class="card-title">Detail Logbook Magang</h3>
        </div>
        <div class="card-body">
            <p><strong>Aktivitas :</strong>{{ $logbook->activity }}</p>
            <p><strong>Hasil :</strong>{{ $logbook->output }}</p>
        </div>
    </div>
    <div class="card m-3">
        <div class="card-header">
            <h3 class="card-title">Dokumentasi</h3>
        </div>
        <div class="card-body">
            @forelse ($images as $img)
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <img src="{{ asset($img->image_path) }}" alt="">
                    </div>
                </div>
            @empty
                <div class="row-justify-content-center">
                    <div class="col-md-12">
                        <p>Tidak Ada Dokumentasi</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

@endsection
