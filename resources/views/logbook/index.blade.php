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

        </div>
        @role('mentor|admin')
            <div class="card-footer">
                <a href="{{ route('interns.show', $intern->uuid) }}" class="btn btn-secondary btn-md">Kembali</a>
            </div>
        @endrole
    </div>
@endsection
